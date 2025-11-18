@extends('layouts.auth')

@section('content')
  <form method="POST" action="{{ route('login') }}" x-data="{ processing: false }" @submit="processing = true"
    class="space-y-6">
    @csrf
    <div class="space-y-4">
      <div class="flex w-full flex-col gap-1 text-neutral-600">
        <label for="email" class="w-fit pl-0.5 text-sm">Email Address</label>
        <input id="email" type="email" value="{{ old('email') }}"
          class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
          name="email" autocomplete="email" required />
        @error('email')
          <small class="pl-0.5 text-red-500">{{ $message }}</small>
        @enderror
      </div>
      <div class="flex w-full flex-col gap-1 text-neutral-600">
        <label for="password" class="w-fit pl-0.5 text-sm">Password</label>
        <div x-data="{ showPassword: false }" class="relative">
          <input x-bind:type="showPassword ? 'text' : 'password'" id="password"
            class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
            name="password" required />
          <button type="button" x-on:click="showPassword = !showPassword"
            class="absolute right-2.5 top-1/2 -translate-y-1/2 text-neutral-600" aria-label="Show password">
            <i data-lucide="eye-off" x-show="!showPassword" class="size-5" stroke-width="1.5"></i>
            <i data-lucide="eye" x-show="showPassword" class="size-5" stroke-width="1.5"></i>
          </button>
        </div>
        @error('password')
          <small class="pl-0.5 text-red-500">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <button type="submit"
      class="w-full whitespace-nowrap rounded-sm bg-black border border-black px-4 py-2 text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed"
      :disabled="processing">Login</button>
  </form>
@endsection