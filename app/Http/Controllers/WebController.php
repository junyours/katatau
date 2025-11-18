<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Journal;
use App\Models\User;
use Hashids\Hashids;
use Http;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home()
    {
        $archive = Archive::query()
            ->orderByDesc('volume')
            ->orderByDesc('issue')
            ->orderByDesc('from_month')
            ->orderByDesc('to_month')
            ->firstOrFail();

        $journals = Journal::query()
            ->where('archive_id', $archive->id)
            ->orderByDesc('publication_date')
            ->limit(3)
            ->get();

        return view('pages.web.home', compact('archive', 'journals'));
    }

    public function editorialBoard()
    {
        $editors = User::query()->where('role', 'editor')
            ->orderByRaw("
            CASE 
                WHEN position = 'Editorial in Chief' THEN 1
                WHEN position = 'Associate Editor' THEN 2
                WHEN position = 'Editorial Board' THEN 3
                ELSE 4
            END
        ")
            ->get();

        return view('pages.web.editorial-board', compact('editors'));
    }

    public function contactUs()
    {
        return view('pages.web.contact-us');
    }

    public function aboutJournal()
    {
        return view('pages.web.category.about-journal');
    }

    public function aboutPublisher()
    {
        return view('pages.web.category.about-publisher');
    }

    public function indexing()
    {
        return view('pages.web.category.indexing');
    }

    public function currentIssue()
    {
        $archive = Archive::query()
            ->orderByDesc('volume')
            ->orderByDesc('issue')
            ->orderByDesc('from_month')
            ->orderByDesc('to_month')
            ->firstOrFail();

        $journals = Journal::query()
            ->where('archive_id', $archive->id)
            ->orderByDesc('publication_date')
            ->get();

        return view('pages.web.category.current-issue', compact('archive', 'journals'));
    }

    public function pastIssue()
    {
        $archives = Archive::query()
            ->orderByDesc('volume')
            ->orderByDesc('issue')
            ->orderByDesc('from_month')
            ->orderByDesc('to_month')
            ->get();

        return view('pages.web.category.past-issue', compact('archives'));
    }

    public function submissionGuideline()
    {
        return view('pages.web.author-menu.submission-guideline');
    }

    public function researchEthics()
    {
        return view('pages.web.author-menu.research-ethics');
    }

    public function index($volume, $issue, $from_month, $to_month)
    {
        $archive = Archive::query()
            ->where('volume', $volume)
            ->where('issue', $issue)
            ->where('from_month', $from_month)
            ->where('to_month', $to_month)
            ->firstOrFail();

        $journals = Journal::query()
            ->where('archive_id', $archive->id)
            ->orderByDesc('publication_date')
            ->get();

        return view('pages.web.archive.index', compact('volume', 'issue', 'from_month', 'to_month', 'journals'));
    }

    public function pdf($volume, $issue, $from_month, $to_month, $hashedId)
    {
        $hashids = new Hashids(config('app.key'), 36);
        $ids = $hashids->decode($hashedId);

        if (empty($ids)) {
            abort(404);
        }

        $id = $ids[0];

        $journal = Journal::findOrFail($id);

        Archive::where('id', $journal->archive_id)
            ->where('volume', $volume)
            ->where('issue', $issue)
            ->where('from_month', $from_month)
            ->where('to_month', $to_month)
            ->firstOrFail();

        $pdfUrl = "https://drive.google.com/uc?export=view&id={$journal->pdf_path}";

        return response()->make(file_get_contents($pdfUrl), 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function abstract($title)
    {
        $journal = Journal::with('archive')
            ->where('title', str_replace('-', ' ', $title))
            ->firstOrFail();

        $authors = array_map('trim', explode(',', $journal->author));
        [$firstpage, $lastpage] = explode('-', $journal->page_number);

        return view('pages.web.archive.abstract', compact('journal', 'authors', 'firstpage', 'lastpage'));
    }
}
