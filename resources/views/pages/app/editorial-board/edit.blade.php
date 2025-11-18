@extends('layouts.app')

@section('content')
  <form method="POST" action="{{ route('admin.editorial-board.update', $editor->id) }}" enctype="multipart/form-data"
    x-data="{ processing: false }" @submit="processing = true" class="max-w-md mx-auto space-y-4">
    @csrf
    <h1 class="font-semibold text-xl">Edit Editorial Board</h1>
    <div class="relative flex w-full flex-col gap-1">
      <label class="w-fit pl-0.5 text-sm text-neutral-600" for="profile_picture">Profile Picture</label>
      <input id="profile_picture" type="file" name="profile_picture"
        class="w-full overflow-clip rounded-sm border border-neutral-300 bg-neutral-50/50 text-sm text-neutral-600 file:mr-4 file:border-none file:bg-neutral-50 file:px-4 file:py-2 file:font-medium file:text-neutral-900 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75" />
      @error('profile_picture')
        <small class="pl-0.5 text-red-500">{{ $message }}</small>
      @enderror
    </div>
    <div class="flex w-full flex-col gap-1 text-neutral-600">
      <label for="name" class="w-fit pl-0.5 text-sm">Name</label>
      <input id="name" type="text" value="{{ $editor->name }}"
        class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
        name="name" autocomplete="name" required />
      @error('name')
        <small class="pl-0.5 text-red-500">{{ $message }}</small>
      @enderror
    </div>
    <div class="flex w-full flex-col gap-1 text-neutral-600">
      <label for="email" class="w-fit pl-0.5 text-sm">Email Address</label>
      <input id="email" type="email" value="{{ $editor->email }}"
        class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
        name="email" autocomplete="email" required />
      @error('email')
        <small class="pl-0.5 text-red-500">{{ $message }}</small>
      @enderror
    </div>
    <div x-data="{
      options: [
        { value: 'Editorial in Chief', label: 'Editorial in Chief' },
        { value: 'Associate Editor', label: 'Associate Editor' },
        { value: 'Editorial Board', label: 'Editorial Board' },
      ],
      isOpen: false,
      openedWithKeyboard: false,
      selectedOption: null,
      init() {
        const existing = this.options.find(o => o.value === '{{ $editor->position }}')
        if (existing) {
          this.selectedOption = existing
          this.$refs.hiddenTextField.value = existing.value
        }
      },
      setSelectedOption(option) {
        this.selectedOption = option
        this.isOpen = false
        this.openedWithKeyboard = false
        this.$refs.hiddenTextField.value = option.value
      },
      highlightFirstMatchingOption(pressedKey) {
        const option = this.options.find(item =>
          item.label.toLowerCase().startsWith(pressedKey.toLowerCase())
        )
        if (option) {
          const index = this.options.indexOf(option)
          const allOptions = document.querySelectorAll('.combobox-option')
          if (allOptions[index]) {
            allOptions[index].focus()
          }
        }
      },
    }" class="w-full flex flex-col gap-1" x-on:keydown="highlightFirstMatchingOption($event.key)"
      x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false">
      <label for="position" class="w-fit pl-0.5 text-sm text-neutral-600">Position</label>
      <div class="relative">
        <button type="button" role="combobox"
          class="inline-flex w-full items-center justify-between gap-2 whitespace-nowrap border-neutral-300 bg-neutral-50 px-4 py-2 text-sm font-medium capitalize tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black rounded-sm border"
          aria-haspopup="listbox" aria-controls="positionList" x-on:click="isOpen = ! isOpen"
          x-on:keydown.down.prevent="openedWithKeyboard = true" x-on:keydown.enter.prevent="openedWithKeyboard = true"
          x-on:keydown.space.prevent="openedWithKeyboard = true"
          x-bind:aria-label="selectedOption ? selectedOption.value : 'Select'"
          x-bind:aria-expanded="isOpen || openedWithKeyboard">
          <span class="text-sm font-normal" x-text="selectedOption ? selectedOption.value : 'Select'"></span>
          <i data-lucide="chevron-down" class="size-5" stroke-width="1.5"></i>
        </button>
        <input id="position" name="position" type="text" x-ref="hiddenTextField" hidden required />
        <ul x-cloak x-show="isOpen || openedWithKeyboard" id="positionList"
          class="absolute z-10 left-0 top-11 flex max-h-44 w-full flex-col overflow-hidden overflow-y-auto border-neutral-300 bg-neutral-50 py-1.5 rounded-sm border"
          role="listbox" aria-label="industries list" x-on:click.outside="isOpen = false, openedWithKeyboard = false"
          x-on:keydown.down.prevent="$focus.wrap().next()" x-on:keydown.up.prevent="$focus.wrap().previous()" x-transition
          x-trap="openedWithKeyboard">
          <template x-for="(item, index) in options" x-bind:key="item.value">
            <li
              class="combobox-option inline-flex justify-between gap-6 bg-neutral-50 px-4 py-2 text-sm text-neutral-600 hover:bg-neutral-900/5 hover:text-neutral-900 focus-visible:bg-neutral-900/5 focus-visible:text-neutral-900 focus-visible:outline-hidden"
              role="option" x-on:click="setSelectedOption(item)" x-on:keydown.enter="setSelectedOption(item)"
              x-bind:id="'option-' + index" tabindex="0">
              <span x-bind:class="selectedOption == item ? 'font-bold' : null" x-text="item.label"></span>
              <span class="sr-only" x-text="selectedOption == item ? 'selected' : null"></span>
              <svg x-cloak x-show="selectedOption == item" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                stroke="currentColor" fill="none" stroke-width="2" class="size-4" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
              </svg>
            </li>
          </template>
        </ul>
      </div>
      @error('position')
        <small class="pl-0.5 text-red-500">{{ $message }}</small>
      @enderror
    </div>
    <div class="flex w-full max-w-md flex-col gap-1 text-neutral-600">
      <label for="department" class="w-fit pl-0.5 text-sm">Department</label>
      <textarea id="department" name="department"
        class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2.5 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
        rows="3" required>{{ $editor->department }}</textarea>
      @error('department')
        <small class="pl-0.5 text-red-500">{{ $message }}</small>
      @enderror
    </div>
    <div class="flex justify-end">
      <button type="submit"
        class="whitespace-nowrap rounded-sm bg-black border border-black px-4 py-2 text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed"
        :disabled="processing">
        Update
      </button>
    </div>
  </form>
@endsection