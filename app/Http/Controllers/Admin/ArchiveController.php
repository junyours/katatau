<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index()
    {
        $archives = Archive::query()
            ->orderByDesc('volume')
            ->orderByDesc('issue')
            ->orderByDesc('from_month')
            ->orderByDesc('to_month')
            ->get();

        return view('pages.app.archive.index', compact('archives'));
    }

    public function create()
    {
        return view('pages.app.archive.create');
    }

    public function add(Request $request)
    {
        $accessToken = $this->token();

        $request->validate([
            'volume' => ['required'],
            'issue' => ['required'],
            'from_month' => ['required'],
            'to_month' => ['required'],
        ]);

        $mainFolder = $this->getOrCreateFolder($accessToken, 'Archives', config('services.google.folder_id'));
        $subFolder = $this->getOrCreateFolder($accessToken, 'Volume' . ' ' . $request->volume . ',' . ' ' . 'Issue' . ' ' . $request->issue . ',' . ' ' . Carbon::parse($request->from_month)->format('F Y') . ' ' . '-' . ' ' . Carbon::parse($request->to_month)->format('F Y'), $mainFolder);

        Archive::create([
            'volume' => $request->volume,
            'issue' => $request->issue,
            'from_month' => $request->from_month,
            'to_month' => $request->to_month,
            'folder_id' => $subFolder,
        ]);

        return redirect()->back()->with('success', 'Archive added successfully!');
    }

    public function edit($id)
    {
        $archive = Archive::findOrFail($id);

        return view('pages.app.archive.edit', compact('archive'));
    }

    public function update(Request $request, $id)
    {
        $accessToken = $this->token();

        $request->validate([
            'volume' => ['required'],
            'issue' => ['required'],
            'from_month' => ['required'],
            'to_month' => ['required'],
        ]);

        $archive = Archive::findOrFail($id);

        $newFolderName =
            'Volume ' . $request->volume . ', ' .
            'Issue ' . $request->issue . ', ' .
            Carbon::parse($request->from_month)->format('F Y') . ' - ' .
            Carbon::parse($request->to_month)->format('F Y');

        $this->renameDriveFolder($accessToken, $archive->folder_id, $newFolderName);

        $archive->update([
            'volume' => $request->volume,
            'issue' => $request->issue,
            'from_month' => $request->from_month,
            'to_month' => $request->to_month,
        ]);

        return redirect()->back()->with('success', 'Archive updated successfully!');
    }

}
