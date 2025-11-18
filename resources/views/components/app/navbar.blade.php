<nav class="sticky top-0 z-10 flex items-center justify-between border-b border-neutral-300 bg-neutral-50 px-4 py-2"
  aria-label="top navibation bar">
  <button type="button" class="md:hidden inline-block text-neutral-600" x-on:click="sidebarIsOpen = true">
    <i data-lucide="panel-left" class="size-5" stroke-width="1.5"></i>
  </button>
  <nav class="hidden md:inline-block"></nav>
  <div x-data="{ userDropdownIsOpen: false }" class="relative" x-on:keydown.esc.window="userDropdownIsOpen = false">
    <button type="button"
      class="flex w-full items-center rounded-sm gap-2 p-2 text-left text-neutral-600 hover:bg-black/5 hover:text-neutral-900 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black"
      x-bind:class="userDropdownIsOpen ? 'bg-black/10' : ''" aria-haspopup="true"
      x-on:click="userDropdownIsOpen = ! userDropdownIsOpen" x-bind:aria-expanded="userDropdownIsOpen">
      <img src="{{ asset('images/user.png') }}" class="size-8 object-cover rounded-full" alt="avatar"
        aria-hidden="true" />
      <div class="hidden md:flex flex-col">
        <span class="text-sm font-bold text-neutral-900">{{ Auth::user()->name }}</span>
        <span class="text-xs" aria-hidden="true">
          {{ Auth::user()->email }}
        </span>
      </div>
    </button>
    <div x-cloak x-show="userDropdownIsOpen"
      class="absolute top-14 right-0 z-20 h-fit w-48 border divide-y divide-neutral-300 border-neutral-300 bg-white rounded-sm"
      role="menu" x-on:click.outside="userDropdownIsOpen = false" x-on:keydown.down.prevent="$focus.wrap().next()"
      x-on:keydown.up.prevent="$focus.wrap().previous()" x-transition="" x-trap="userDropdownIsOpen">
      <div class="flex flex-col py-1.5">
        <a href="#"
          class="flex items-center gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden"
          role="menuitem">
          <i data-lucide="user" class="size-5" stroke-width="1.5"></i>
          <span>Profile</span>
        </a>
      </div>
      <div class="flex flex-col py-1.5">
        <form method="POST" action="{{ route('logout') }}" x-data="{ processing: false }" @submit="processing = true">
          @csrf
          <button type="submit"
            class="w-full flex items-center gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden disabled:opacity-75 disabled:cursor-not-allowed"
            :disabled="processing">
            <i data-lucide="log-out" class="size-5" stroke-width="1.5"></i>
            <span>Sign Out</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</nav>