@php
  $items = [
    [
      'name' => 'About Us',
      'subitems' => [
        ['name' => 'About the Journal', 'route' => route('about-journal')],
        ['name' => 'About the Publisher', 'route' => route('about-publisher')],
      ]
    ],
    [
      'name' => 'Issues',
      'subitems' => [
        ['name' => 'Current Issue', 'route' => route('current-issue')],
        ['name' => 'Past Issue', 'route' => route('past-issue')],
      ]
    ],
    [
      'name' => 'Authors',
      'subitems' => [
        ['name' => 'Submission Guidelines', 'route' => route('submission-guideline')],
        ['name' => 'Research Ethics', 'route' => route('research-ethics')],
      ]
    ],
    ['name' => 'Editorial Board', 'route' => 'editorial-board'],
    ['name' => 'Contact Us', 'route' => 'contact-us'],
  ]
@endphp
<div class="hidden md:block">
  <div class="max-w-6xl mx-auto py-4 border-b border-slate-300 flex items-center justify-between gap-4">
    <div class="flex items-center justify-between gap-4">
      <div class="flex items-center gap-4">
        <div class="flex items-center gap-2">
          <i data-lucide="mail" class="size-5 text-[#AD0404]" stroke-width="1.5"></i>
          <a href="mailto:ditads@infosheet.dev" target="_blank"
            class="font-semibold hover:text-[#AD0404]">ditads@infosheet.dev</a>
        </div>
        <div class="flex items-center gap-2">
          <i data-lucide="phone" class="size-5 text-[#AD0404]" stroke-width="1.5"></i>
          <a href="tel:+639171281320" target="_blank" class="font-semibold hover:text-[#AD0404]">+63 917 128 1320</a>
        </div>
        <div class="flex items-center gap-2">
          <i data-lucide="map-pin" class="size-5 text-[#AD0404]" stroke-width="1.5"></i>
          <a href="https://maps.app.goo.gl/WLB5KaEyTygUozGJ9" target="_blank"
            class="font-semibold hover:text-[#AD0404]">Metro
            Square R118
            Zone 2, Iponan,
            CDO City</a>
        </div>
      </div>
    </div>
    @if (Auth::check())
      <a href="{{ route('dashboard') }}" class="font-semibold hover:text-[#AD0404]">Dashboard</a>
    @else
      <a href="{{ route('login') }}" class="font-semibold hover:text-[#AD0404]">Login</a>
    @endif
  </div>
</div>
<nav x-data="{ mobileMenuIsOpen: false }" x-on:click.away="mobileMenuIsOpen = false" aria-label="penguin ui menu">
  <div class="max-w-6xl mx-auto flex items-center justify-between gap-4 py-4">
    <a href={{ route('home') }}>
      <img src={{ asset('images/logo.png') }} class="h-12" alt="logo" />
    </a>
    <div class="hidden items-center gap-8 md:flex">
      <ul class="flex items-center gap-4">
        @foreach ($items as $item)
          @if (isset($item['subitems']))
            <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
              <button class="flex items-center gap-2 hover:text-[#AD0404] font-semibold cursor-pointer"
                @click="open = !open" :aria-expanded="open">
                {{ $item['name'] }}
                <i data-lucide="chevron-down" class="size-5 shrink-0 transition" stroke-width="1.5"></i>
              </button>
              <div
                class="absolute min-w-[280px] left-1/2 top-full -translate-x-1/2 mt-4 bg-[#AD0404] shadow-md z-50 rounded-md pt-0.5"
                x-show="open" x-transition.origin.top.duration.200ms x-cloak>
                <li class="flex flex-col gap-4 bg-white px-6 py-4 rounded-md">
                  @foreach ($item['subitems'] as $subitem)
                    <a href="{{ $subitem['route'] }}" class="font-semibold hover:text-[#AD0404]">
                      {{ $subitem['name'] }}
                    </a>
                  @endforeach
                </li>
              </div>
            </div>
          @else
            <li>
              <a href="{{ route($item['route']) }}" class="font-semibold hover:text-[#AD0404]">
                {{ $item['name'] }}
              </a>
            </li>
          @endif
        @endforeach
      </ul>
      <a href="mailto:ditads@infosheet.dev" target="_blank">
        <button type="button"
          class="whitespace-nowrap rounded-md bg-[#AD0404] border border-[#AD0404] px-4 py-2 font-semibold tracking-wide text-neutral-100 transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#AD0404] active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed">Submit
          Paper</button>
      </a>
    </div>
    <button x-on:click="mobileMenuIsOpen = !mobileMenuIsOpen" x-bind:aria-expanded="mobileMenuIsOpen" type="button"
      class="flex z-20 md:hidden" aria-label="mobile menu" aria-controls="mobileMenu">
      <i data-lucide="menu" x-cloak x-show="!mobileMenuIsOpen" class="size-5" stroke-width="1.5" aria-hidden="true"></i>
      <i data-lucide="x" x-cloak x-show="mobileMenuIsOpen" class="size-5" stroke-width="1.5" aria-hidden="true"></i>
    </button>
    <ul x-cloak x-show="mobileMenuIsOpen"
      x-transition:enter="transition motion-reduce:transition-none ease-out duration-300"
      x-transition:enter-start="-translate-y-full" x-transition:enter-end="translate-y-0"
      x-transition:leave="transition motion-reduce:transition-none ease-out duration-300"
      x-transition:leave-start="translate-y-0" x-transition:leave-end="-translate-y-full" id="mobileMenu"
      class="fixed max-h-svh overflow-y-auto inset-x-0 top-0 z-10 flex flex-col divide-y divide-neutral-300 border-b border-neutral-300 bg-neutral-50 px-4 pb-4 pt-24 md:hidden">
      @foreach ($items as $item)
        @if (isset($item['subitems']))
          <div x-data="{ isExpanded: false }" class="py-4">
            <button type="button" class="font-medium flex w-full items-center justify-between gap-4 text-left"
              x-on:click="isExpanded = ! isExpanded" x-bind:aria-expanded="isExpanded ? 'true' : 'false'">
              {{ $item['name'] }}
              <i data-lucide="chevron-down" class="size-5 shrink-0 transition" stroke-width="1.5"
                x-bind:class="isExpanded  ?  'rotate-180'  :  ''"></i>
            </button>
            <li x-cloak x-show="isExpanded" x-collapse class="flex flex-col gap-2 mt-2">
              @foreach ($item['subitems'] as $subitem)
                <a href="{{ $subitem['route'] }}" class="w-full font-medium focus:underline">
                  {{ $subitem['name'] }}
                </a>
              @endforeach
            </li>
          </div>
        @else
          <li>
            <a href="{{ route($item['route']) }}" class="block py-4 font-medium">
              {{ $item['name'] }}
            </a>
          </li>
        @endif
      @endforeach
    </ul>
  </div>
</nav>