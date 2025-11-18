@php
  $hashids = new Hashids\Hashids(config('app.key'), 36);
  $hashedId = $hashids->encode($journal->id);
@endphp

@extends('layouts.web')

@section('meta')
  <meta name="citation_title" content="{{ $journal->title }}">
  @foreach($authors as $author)
    <meta name="citation_author" content="{{ $author }}">
  @endforeach
  <meta name="citation_publication_date"
    content="{{ \Carbon\Carbon::parse($journal->publication_date)->format('Y/m/d') }}">
  <meta name="citation_journal_title" content="Diskurso International Multidisciplinary Research Journal">
  <meta name="citation_volume" content="{{ $journal->archive->volume }}">
  <meta name="citation_issue" content="{{ $journal->archive->issue }}">
  <meta name="citation_firstpage" content="{{ trim($firstpage) }}">
  <meta name="citation_lastpage" content="{{ trim($lastpage) }}">
  <meta name="citation_pdf_url" content="{{ route('archive.pdf', [
    'volume' => $journal->archive->volume,
    'issue' => $journal->archive->issue,
    'from_month' => $journal->archive->from_month,
    'to_month' => $journal->archive->to_month,
    'hashedId' => $hashedId,
  ]) }}">
@endsection

@section('content')
  <div class="space-y-4">
    <h1 class="font-bold text-[#AD0404] text-base border-b border-slate-300 pb-4 uppercase">{{ $journal->title }}
    </h1>
    <div class="space-y-2">
      <h2 class="font-semibold">Author: <span class="font-medium">{{ $journal->author }}</span></h2>
      <h2 class="font-semibold">Country: <span class="font-medium">{{ $journal->country }}</span></h2>
      <h2 class="font-semibold">Volume & Issue: <span class="font-medium">Volume {{ $journal->archive->volume }},
          Issue
          {{ $journal->archive->issue }},
          {{ Carbon\Carbon::parse($journal->archive->from_month)->format('F Y') }} -
          {{ Carbon\Carbon::parse($journal->archive->to_month)->format('F Y') }}</span>
      </h2>
      <h2 class="font-semibold">Page No.: <span class="font-medium">{{ $journal->page_number }}</span></h2>
      <h2 class="font-semibold">DOI.: <a href="https://doi.org/{{ $journal->doi }}" target="_blank"
          class="font-medium hover:underline">https://doi.org/{{ $journal->doi }}</a></h2>
      <h2 class="font-semibold">Publication Date: <span
          class="font-medium">{{ \Carbon\Carbon::parse($journal->publication_date)->format('F j, Y') }}</span>
      </h2>
    </div>
    <div>
      <h2 class="font-semibold">Abstract:</h2>
      <p class="whitespace-break-spaces font-medium">{{ $journal->abstract }}</p>
    </div>
    <div>
      <h2 class="font-semibold">Keywords:</h2>
      <p class="font-medium">{{ $journal->keyword }}</p>
    </div>
    <a href="{{ route('archive.pdf', [
    'volume' => $journal->archive->volume,
    'issue' => $journal->archive->issue,
    'from_month' => $journal->archive->from_month,
    'to_month' => $journal->archive->to_month,
    'hashedId' => $hashedId,
  ]) }}" target="_blank">
      <button type="button"
        class="inline-flex justify-center items-center gap-2 whitespace-nowrap rounded-md border border-[#AD0404] px-3 py-1.5 text-xs font-medium tracking-wide transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#AD0404] active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed">
        <img src="{{ asset('images/pdf.png') }}" class="w-5 object-contain">
        PDF Open Access
      </button>
    </a>
  </div>
@endsection