@php
  $archives = App\Models\Archive::query()
    ->orderByDesc('volume')
    ->orderByDesc('issue')
    ->orderByDesc('from_month')
    ->orderByDesc('to_month')
    ->limit(10)
    ->get();
@endphp

<div>
  <h1 class="bg-[#AD0404] text-white px-4 py-2 font-bold rounded-md">Quarterly Archive</h1>
  @foreach ($archives as $archive)
    <a href="{{ route('archive', [
      'volume' => $archive->volume,
      'issue' => $archive->issue,
      'from_month' => $archive->from_month,
      'to_month' => $archive->to_month
    ]) }}" class="flex items-center gap-2 hover:text-[#AD0404] px-4 py-2 border-b border-slate-300">
      <i data-lucide="circle-plus" class="size-5 shrink-0" stroke-width="1.5"></i>
      <span class="font-semibold">Volume {{ $archive->volume }}, Issue {{ $archive->issue }},
        {{ Carbon\Carbon::parse($archive->from_month)->format('F Y') }} -
        {{ Carbon\Carbon::parse($archive->to_month)->format('F Y') }}</span>
    </a>
  @endforeach
</div>