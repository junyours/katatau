@extends('layouts.app')

@section('content')
  <div class="space-y-4">
    <div class="flex justify-end">
      <a href="{{ route('admin.editorial-board.create') }}">
        <button type="button"
          class="inline-flex justify-center items-center gap-2 whitespace-nowrap rounded-sm bg-black border border-black px-4 py-2 text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed">
          <i data-lucide="plus" class="size-5" stroke-width="1.5"></i>
          Create
        </button>
      </a>
    </div>
    <div class="overflow-hidden w-full overflow-x-auto rounded-sm border border-neutral-300">
      <table class="w-full text-left text-sm text-neutral-600">
        <thead class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900">
          <tr>
            <th scope="col" class="p-4"></th>
            <th scope="col" class="p-4">Position</th>
            <th scope="col" class="p-4">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-neutral-300">
          @foreach ($editors as $editor)
            <tr>
              <td class="p-4">
                <div class="flex w-max items-center gap-2">
                  <img class="size-10 rounded-full object-cover"
                    src="https://lh3.googleusercontent.com/d/{{ $editor->profile_picture }}" alt="{{ $editor->name }}" />
                  <div class="flex flex-col">
                    <span class="text-neutral-900">{{ $editor->name }}</span>
                    <span class="text-sm text-neutral-600 opacity-85">{{ $editor->email }}</span>
                  </div>
                </div>
              </td>
              <td class="p-4">{{ $editor->position }}</td>
              <td class="p-4">
                <a href="{{ route('admin.editorial-board.edit', $editor->id) }}">
                  <button type="button"
                    class="whitespace-nowrap rounded-sm bg-transparent p-0.5 font-semibold text-black outline-black hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0">Edit</button>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection