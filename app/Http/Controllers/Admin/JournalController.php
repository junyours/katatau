<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Models\Journal;
use Carbon\Carbon;
use Http;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index($volume, $issue, $from_month, $to_month)
    {
        $archive = Archive::where('volume', $volume)
            ->where('issue', $issue)
            ->where('from_month', $from_month)
            ->where('to_month', $to_month)
            ->firstOrFail();

        $journals = Journal::query()
            ->where('archive_id', $archive->id)
            ->orderByDesc('publication_date')
            ->get();

        return view('pages.app.archive.journal.index', compact('archive', 'journals'));
    }

    public function create($folder_id)
    {
        $archive = Archive::where('folder_id', $folder_id)
            ->firstOrFail();

        return view('pages.app.archive.journal.create', compact('archive'));
    }

    public function add(Request $request, $id)
    {
        $archive = Archive::findOrFail($id);

        $accessToken = $this->token();

        $request->validate([
            'pdf_path' => ['required', 'mimes:pdf'],
            'title' => ['required'],
            'author' => ['required'],
            'country' => ['required'],
            'page_number' => ['required'],
            'abstract' => ['required'],
            'keyword' => ['required'],
            'doi' => ['required'],
            'publication_date' => ['required'],
        ]);

        $file = $request->file('pdf_path');
        $mimeType = $file->getMimeType();

        $metadata = [
            'name' => $file->getClientOriginalName(),
            'parents' => [$archive->folder_id],
        ];

        $uploadResponse = Http::withToken($accessToken)
            ->attach('metadata', json_encode($metadata), 'metadata.json', ['Content-Type' => 'application/json'])
            ->attach('media', file_get_contents($file), $file->getClientOriginalName(), ['Content-Type' => $mimeType])
            ->post('https://www.googleapis.com/upload/drive/v3/files?uploadType=multipart');

        if ($uploadResponse->successful()) {
            $fileId = $uploadResponse->json()['id'];

            $fileName = $fileId . '.pdf';

            Http::withToken($accessToken)->patch("https://www.googleapis.com/drive/v3/files/{$fileId}", [
                'name' => $fileName,
            ]);

            Http::withToken($accessToken)->post("https://www.googleapis.com/drive/v3/files/{$fileId}/permissions", [
                'role' => 'reader',
                'type' => 'anyone',
            ]);

            Journal::create([
                'archive_id' => $archive->id,
                'pdf_path' => $fileId,
                'title' => $request->title,
                'author' => $request->author,
                'country' => $request->country,
                'page_number' => $request->page_number,
                'abstract' => $request->abstract,
                'keyword' => $request->keyword,
                'doi' => $request->doi,
                'publication_date' => Carbon::parse($request->publication_date)
                    ->timezone('Asia/Manila')
                    ->toDateString(),
            ]);

            return redirect()->back()->with('success', 'Journal added successfully!');
        }
    }

    public function edit($id)
    {
        $journal = Journal::with('archive')->findOrFail($id);

        return view('pages.app.archive.journal.edit', compact('journal'));
    }

    public function update(Request $request, $id)
    {
        $journal = Journal::findOrFail($id);
        $archive = $journal->archive;

        $accessToken = $this->token();

        $request->validate([
            'title' => ['required'],
            'author' => ['required'],
            'country' => ['required'],
            'page_number' => ['required'],
            'abstract' => ['required'],
            'keyword' => ['required'],
            'doi' => ['required'],
            'publication_date' => ['required'],
        ]);

        $journal->update([
            'title' => $request->title,
            'author' => $request->author,
            'country' => $request->country,
            'page_number' => $request->page_number,
            'abstract' => $request->abstract,
            'keyword' => $request->keyword,
            'doi' => $request->doi,
            'publication_date' => Carbon::parse($request->publication_date)
                ->timezone('Asia/Manila')
                ->toDateString(),
        ]);

        if ($request->hasFile('pdf_path')) {
            $request->validate([
                'pdf_path' => ['mimes:pdf'],
            ]);

            Http::withToken($accessToken)->delete("https://www.googleapis.com/drive/v3/files/{$journal->pdf_path}");

            $file = $request->file('pdf_path');
            $mimeType = $file->getMimeType();

            $metadata = [
                'name' => $file->getClientOriginalName(),
                'parents' => [$archive->folder_id],
            ];

            $uploadResponse = Http::withToken($accessToken)
                ->attach('metadata', json_encode($metadata), 'metadata.json', ['Content-Type' => 'application/json'])
                ->attach('media', file_get_contents($file), $file->getClientOriginalName(), ['Content-Type' => $mimeType])
                ->post('https://www.googleapis.com/upload/drive/v3/files?uploadType=multipart');

            if ($uploadResponse->successful()) {
                $fileId = $uploadResponse->json()['id'];

                $fileName = $fileId . '.pdf';

                Http::withToken($accessToken)->patch("https://www.googleapis.com/drive/v3/files/{$fileId}", [
                    'name' => $fileName,
                ]);

                Http::withToken($accessToken)->post("https://www.googleapis.com/drive/v3/files/{$fileId}/permissions", [
                    'role' => 'reader',
                    'type' => 'anyone',
                ]);

                $journal->update([
                    'pdf_path' => $fileId,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Journal updated successfully!');
    }
}
