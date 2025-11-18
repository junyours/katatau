@extends('layouts.app')

@section('content')
  <form method="POST" action="{{ route('admin.archive.add') }}" x-data="{ processing: false }" @submit="processing = true"
    class="max-w-md mx-auto space-y-4">
    @csrf
    <h1 class="font-semibold text-xl">Create Quarterly Archive</h1>
    <div class="flex w-full flex-col gap-1 text-neutral-600">
      <label for="volume" class="w-fit pl-0.5 text-sm">Volume</label>
      <input id="volume" type="text" value="{{ old('volume') }}"
        class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
        name="volume" required />
      @error('volume')
        <small class="pl-0.5 text-red-500">{{ $message }}</small>
      @enderror
    </div>
    <div class="flex w-full flex-col gap-1 text-neutral-600">
      <label for="issue" class="w-fit pl-0.5 text-sm">Issue</label>
      <input id="issue" type="text" value="{{ old('issue') }}"
        class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
        name="issue" required />
      @error('issue')
        <small class="pl-0.5 text-red-500">{{ $message }}</small>
      @enderror
    </div>
    <div class="grid grid-cols-2 gap-4">
      <div class="flex w-full flex-col gap-1 text-neutral-600">
        <label for="from_month" class="w-fit pl-0.5 text-sm">From Month</label>
        <input id="from_month" type="month" value="{{ old('from_month') }}"
          class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
          name="from_month" required />
        @error('from_month')
          <small class="pl-0.5 text-red-500">{{ $message }}</small>
        @enderror
      </div>
      <div class="flex w-full flex-col gap-1 text-neutral-600">
        <label for="to_month" class="w-fit pl-0.5 text-sm">To Month</label>
        <input id="to_month" type="month" value="{{ old('to_month') }}"
          class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
          name="to_month" required />
        @error('to_month')
          <small class="pl-0.5 text-red-500">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <div class="flex justify-end">
      <button type="submit"
        class="whitespace-nowrap rounded-sm bg-black border border-black px-4 py-2 text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed"
        :disabled="processing">
        Save
      </button>
    </div>
  </form>
@endsection