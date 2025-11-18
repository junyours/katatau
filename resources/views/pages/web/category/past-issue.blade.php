@extends('layouts.web')

@section('content')
  <div class="space-y-4">
    <h1 class="font-bold text-base border-b border-slate-300 pb-4">Past Issue | Quarterly Archive</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      @foreach ($archives as $archive)
          <a href="{{ route('archive', [
          'volume' => $archive->volume,
          'issue' => $archive->issue,
          'from_month' => $archive->from_month,
          'to_month' => $archive->to_month,
        ]) }}" class="border border-slate-300 rounded-md p-4 hover:text-[#AD0404]">
            <span class="font-semibold">Volume {{ $archive->volume }}, Issue {{ $archive->issue }},
              {{ Carbon\Carbon::parse($archive->from_month)->format('F Y') }} -
              {{ Carbon\Carbon::parse($archive->to_month)->format('F Y') }}</span>
          </a>
      @endforeach
    </div>
  </div>
@endsection