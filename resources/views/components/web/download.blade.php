@php
  $items = [
    ['name' => 'Katatau-Journal-New-Format', 'path' => 'files/downloads/Katatau-Journal-New-Format.docx'],
  ]
@endphp

<div>
  <h1 class="bg-[#AD0404] text-white px-4 py-2 font-bold rounded-md">Downloads</h1>
  @foreach ($items as $item)
    <a href={{ asset($item['path']) }} target="_blank"
      class="flex items-center gap-2 hover:text-[#AD0404] px-4 py-2 border-b border-slate-300">
      <i data-lucide="download" class="size-5 shrink-0" stroke-width="1.5"></i>
      <span class="font-semibold">{{ $item['name'] }}</span>
    </a>
  @endforeach
</div>