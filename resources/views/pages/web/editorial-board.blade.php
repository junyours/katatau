@extends('layouts.web')

@section('content')
  <div class="space-y-4">
    <h1 class="font-bold text-base border-b border-slate-300 pb-4">Editorial Board</h1>
    @php
      $groupedEditors = $editors->groupBy('position');
    @endphp
    @foreach ($groupedEditors as $position => $group)
      <div class="space-y-2">
        <h2 class="font-semibold">{{ $position }}</h2>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-2">
          @foreach ($group as $editor)
            <div class="border border-slate-300 rounded-md">
              <img src="https://lh3.googleusercontent.com/d/{{ $editor->profile_picture }}" alt="{{ $editor->name }}"
                class="object-cover w-full h-60">
              <div class="p-4 flex flex-col gap-2">
                <h2 class="font-semibold wrap-break-word">{{ $editor->name }}</h2>
                <a href="mailto:{{ $editor->email }}"
                  class="text-xs font-medium wrap-break-word text-[#AD0404] hover:underline">{{ $editor->email }}</a>
                <p class="font-medium text-slate-600 wrap-break-word">{{ $editor->department }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endforeach
  </div>
@endsection