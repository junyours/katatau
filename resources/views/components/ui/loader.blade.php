<div x-show="loading" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
  x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
  x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
  class="fixed inset-0 z-99 flex items-center justify-center bg-white" x-cloak>
  <img src="{{ asset('images/icon.png') }}" alt="icon" class="size-48 object-contain animate-pulse">
</div>