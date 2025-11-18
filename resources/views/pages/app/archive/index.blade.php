@extends('layouts.app')

@section('content')
  <div class="space-y-4">
    <div class="flex justify-end">
      <a href="{{ route('admin.archive.create') }}">
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
            <th scope="col" class="p-4">Volume</th>
            <th scope="col" class="p-4">Issue</th>
            <th scope="col" class="p-4">Quarterly</th>
            <th scope="col" class="p-4">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-neutral-300">
          @foreach ($archives as $archive)
                  <tr>
                    <td class="p-4">{{ $archive->volume }}</td>
                    <td class="p-4">{{ $archive->issue }}</td>
                    <td class="p-4">{{ Carbon\Carbon::parse($archive->from_month)->format('F Y') }} -
                      {{ Carbon\Carbon::parse($archive->to_month)->format('F Y') }}
                    </td>
                    <td class="p-4 space-x-2">
                      <a href="{{ route('admin.journal', [
              'volume' => $archive->volume,
              'issue' => $archive->issue,
              'from_month' => $archive->from_month,
              'to_month' => $archive->to_month,
            ]) }}"
                        class="whitespace-nowrap rounded-sm bg-transparent p-0.5 font-semibold text-green-500 outline-green-500 hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0">Open</a>
                      <a href="{{ route('admin.archive.edit', $archive->id) }}"
                        class="whitespace-nowrap rounded-sm bg-transparent p-0.5 font-semibold text-blue-500 outline-blue-500 hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0">Edit</a>
                    </td>
                  </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection