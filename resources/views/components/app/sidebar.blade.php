@php
  $items = [
    ['name' => 'Dashboard', 'icon' => 'layout-grid', 'route' => 'dashboard'],
    ['name' => 'Editorial Board', 'icon' => 'users', 'route' => 'admin.editorial-board'],
    ['name' => 'Quarterly Archive', 'icon' => 'archive', 'route' => 'admin.archive'],
  ]
@endphp

<nav x-cloak
  class="fixed left-0 z-30 flex gap-6 h-svh w-60 shrink-0 flex-col border-r border-neutral-300 bg-neutral-50 p-4 transition-transform duration-300 md:w-64 md:translate-x-0 md:relative"
  x-bind:class="sidebarIsOpen ? 'translate-x-0' : '-translate-x-60'" aria-label="sidebar navigation">
  <a href={{ route('home') }}>
    <img src={{ asset('images/logo.png') }} class="object-contain" alt="logo" />
  </a>
  <div class="flex flex-col gap-2 overflow-y-auto pb-6">
    @foreach ($items as $item)
      <a href="{{ route($item['route']) }}"
        class="flex items-center rounded-sm gap-2 px-2 py-1.5 text-sm font-medium underline-offset-2 focus-visible:underline focus:outline-hidden {{ request()->routeIs($item['route']) ? 'bg-black/10 text-neutral-900' : 'text-neutral-600 hover:bg-black/5 hover:text-neutral-900' }}">
        <i data-lucide="{{ $item['icon'] }}" class="size-5" stroke-width="1.5"></i>
        <span>{{ $item['name'] }}</span>
      </a>
    @endforeach
  </div>
</nav>