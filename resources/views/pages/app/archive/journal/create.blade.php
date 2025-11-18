@extends('layouts.app')

@section('content')
  <form method="POST" action="{{ route('admin.journal.add', $archive->id) }}" enctype="multipart/form-data"
    x-data="{ processing: false }" @submit="processing = true" class="max-w-md mx-auto space-y-4">
    @csrf
    <h1 class="capitalize font-semibold">Volume {{ $archive->volume }}, Issue {{ $archive->issue }},
      {{ Carbon\Carbon::parse($archive->from_month)->format('F Y') }} -
      {{ Carbon\Carbon::parse($archive->to_month)->format('F Y') }}
    </h1>
    <h1 class="font-semibold text-xl">Create Journal</h1>
    <div class="flex w-full flex-col gap-1 text-neutral-600">
      <label for="pdf_path" class="w-fit pl-0.5 text-sm">PDF</label>
      <input id="pdf_path" type="file" value="{{ old('pdf_path') }}"
        class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
        name="pdf_path" accept="application/pdf" required />
      @error('pdf_path')
        <small class="pl-0.5 text-red-500">{{ $message }}</small>
      @enderror
    </div>
    <div class="flex w-full flex-col gap-1 text-neutral-600">
      <label for="title" class="w-fit pl-0.5 text-sm">Title</label>
      <input id="title" type="text" value="{{ old('title') }}"
        class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
        name="title" required />
      @error('title')
        <small class="pl-0.5 text-red-500">{{ $message }}</small>
      @enderror
    </div>
    <div class="flex w-full flex-col gap-1 text-neutral-600">
      <label for="author" class="w-fit pl-0.5 text-sm">Authors</label>
      <input id="author" type="text" value="{{ old('author') }}"
        class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
        name="author" required />
      @error('author')
        <small class="pl-0.5 text-red-500">{{ $message }}</small>
      @enderror
    </div>
    <div class="flex w-full flex-col gap-1 text-neutral-600">
      <label for="doi" class="w-fit pl-0.5 text-sm">DOI</label>
      <input id="doi" type="text" value="{{ old('doi') }}"
        class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
        name="doi" required />
      @error('doi')
        <small class="pl-0.5 text-red-500">{{ $message }}</small>
      @enderror
    </div>
    <div x-data="{
                                    allOptions: [
                                          { label: 'Afghanistan', value: 'Afghanistan' },
                            { label: 'Albania', value: 'Albania' },
                            { label: 'Algeria', value: 'Algeria' },
                            { label: 'Andorra', value: 'Andorra' },
                            { label: 'Angola', value: 'Angola' },
                            { label: 'Antigua and Barbuda', value: 'Antigua and Barbuda' },
                            { label: 'Argentina', value: 'Argentina' },
                            { label: 'Armenia', value: 'Armenia' },
                            { label: 'Australia', value: 'Australia' },
                            { label: 'Austria', value: 'Austria' },
                            { label: 'Azerbaijan', value: 'Azerbaijan' },
                            { label: 'Bahamas', value: 'Bahamas' },
                            { label: 'Bahrain', value: 'Bahrain' },
                            { label: 'Bangladesh', value: 'Bangladesh' },
                            { label: 'Barbados', value: 'Barbados' },
                            { label: 'Belarus', value: 'Belarus' },
                            { label: 'Belgium', value: 'Belgium' },
                            { label: 'Belize', value: 'Belize' },
                            { label: 'Benin', value: 'Benin' },
                            { label: 'Bhutan', value: 'Bhutan' },
                            { label: 'Bolivia', value: 'Bolivia' },
                            { label: 'Bosnia and Herzegovina', value: 'Bosnia and Herzegovina' },
                            { label: 'Botswana', value: 'Botswana' },
                            { label: 'Brazil', value: 'Brazil' },
                            { label: 'Brunei', value: 'Brunei' },
                            { label: 'Bulgaria', value: 'Bulgaria' },
                            { label: 'Burkina Faso', value: 'Burkina Faso' },
                            { label: 'Burundi', value: 'Burundi' },
                            { label: 'Cambodia', value: 'Cambodia' },
                            { label: 'Cameroon', value: 'Cameroon' },
                            { label: 'Canada', value: 'Canada' },
                            { label: 'Cape Verde', value: 'Cape Verde' },
                            { label: 'Central African Republic', value: 'Central African Republic' },
                            { label: 'Chad', value: 'Chad' },
                            { label: 'Chile', value: 'Chile' },
                            { label: 'China', value: 'China' },
                            { label: 'Colombia', value: 'Colombia' },
                            { label: 'Comoros', value: 'Comoros' },
                            { label: 'Congo (Brazzaville)', value: 'Congo (Brazzaville)' },
                            { label: 'Congo (Kinshasa)', value: 'Congo (Kinshasa)' },
                            { label: 'Costa Rica', value: 'Costa Rica' },
                            { label: 'Croatia', value: 'Croatia' },
                            { label: 'Cuba', value: 'Cuba' },
                            { label: 'Cyprus', value: 'Cyprus' },
                            { label: 'Czech Republic', value: 'Czech Republic' },
                            { label: 'Denmark', value: 'Denmark' },
                            { label: 'Djibouti', value: 'Djibouti' },
                            { label: 'Dominica', value: 'Dominica' },
                            { label: 'Dominican Republic', value: 'Dominican Republic' },
                            { label: 'Ecuador', value: 'Ecuador' },
                            { label: 'Egypt', value: 'Egypt' },
                            { label: 'El Salvador', value: 'El Salvador' },
                            { label: 'Equatorial Guinea', value: 'Equatorial Guinea' },
                            { label: 'Eritrea', value: 'Eritrea' },
                            { label: 'Estonia', value: 'Estonia' },
                            { label: 'Eswatini', value: 'Eswatini' },
                            { label: 'Ethiopia', value: 'Ethiopia' },
                            { label: 'Fiji', value: 'Fiji' },
                            { label: 'Finland', value: 'Finland' },
                            { label: 'France', value: 'France' },
                            { label: 'Gabon', value: 'Gabon' },
                            { label: 'Gambia', value: 'Gambia' },
                            { label: 'Georgia', value: 'Georgia' },
                            { label: 'Germany', value: 'Germany' },
                            { label: 'Ghana', value: 'Ghana' },
                            { label: 'Greece', value: 'Greece' },
                            { label: 'Grenada', value: 'Grenada' },
                            { label: 'Guatemala', value: 'Guatemala' },
                            { label: 'Guinea', value: 'Guinea' },
                            { label: 'Guinea-Bissau', value: 'Guinea-Bissau' },
                            { label: 'Guyana', value: 'Guyana' },
                            { label: 'Haiti', value: 'Haiti' },
                            { label: 'Honduras', value: 'Honduras' },
                            { label: 'Hungary', value: 'Hungary' },
                            { label: 'Iceland', value: 'Iceland' },
                            { label: 'India', value: 'India' },
                            { label: 'Indonesia', value: 'Indonesia' },
                            { label: 'Iran', value: 'Iran' },
                            { label: 'Iraq', value: 'Iraq' },
                            { label: 'Ireland', value: 'Ireland' },
                            { label: 'Israel', value: 'Israel' },
                            { label: 'Italy', value: 'Italy' },
                            { label: 'Jamaica', value: 'Jamaica' },
                            { label: 'Japan', value: 'Japan' },
                            { label: 'Jordan', value: 'Jordan' },
                            { label: 'Kazakhstan', value: 'Kazakhstan' },
                            { label: 'Kenya', value: 'Kenya' },
                            { label: 'Kiribati', value: 'Kiribati' },
                            { label: 'Kuwait', value: 'Kuwait' },
                            { label: 'Kyrgyzstan', value: 'Kyrgyzstan' },
                            { label: 'Laos', value: 'Laos' },
                            { label: 'Latvia', value: 'Latvia' },
                            { label: 'Lebanon', value: 'Lebanon' },
                            { label: 'Lesotho', value: 'Lesotho' },
                            { label: 'Liberia', value: 'Liberia' },
                            { label: 'Libya', value: 'Libya' },
                            { label: 'Liechtenstein', value: 'Liechtenstein' },
                            { label: 'Lithuania', value: 'Lithuania' },
                            { label: 'Luxembourg', value: 'Luxembourg' },
                            { label: 'Madagascar', value: 'Madagascar' },
                            { label: 'Malawi', value: 'Malawi' },
                            { label: 'Malaysia', value: 'Malaysia' },
                            { label: 'Maldives', value: 'Maldives' },
                            { label: 'Mali', value: 'Mali' },
                            { label: 'Malta', value: 'Malta' },
                            { label: 'Marshall Islands', value: 'Marshall Islands' },
                            { label: 'Mauritania', value: 'Mauritania' },
                            { label: 'Mauritius', value: 'Mauritius' },
                            { label: 'Mexico', value: 'Mexico' },
                            { label: 'Micronesia', value: 'Micronesia' },
                            { label: 'Moldova', value: 'Moldova' },
                            { label: 'Monaco', value: 'Monaco' },
                            { label: 'Mongolia', value: 'Mongolia' },
                            { label: 'Montenegro', value: 'Montenegro' },
                            { label: 'Morocco', value: 'Morocco' },
                            { label: 'Mozambique', value: 'Mozambique' },
                            { label: 'Myanmar', value: 'Myanmar' },
                            { label: 'Namibia', value: 'Namibia' },
                            { label: 'Nauru', value: 'Nauru' },
                            { label: 'Nepal', value: 'Nepal' },
                            { label: 'Netherlands', value: 'Netherlands' },
                            { label: 'New Zealand', value: 'New Zealand' },
                            { label: 'Nicaragua', value: 'Nicaragua' },
                            { label: 'Niger', value: 'Niger' },
                            { label: 'Nigeria', value: 'Nigeria' },
                            { label: 'North Korea', value: 'North Korea' },
                            { label: 'North Macedonia', value: 'North Macedonia' },
                            { label: 'Norway', value: 'Norway' },
                            { label: 'Oman', value: 'Oman' },
                            { label: 'Pakistan', value: 'Pakistan' },
                            { label: 'Palau', value: 'Palau' },
                            { label: 'Palestine', value: 'Palestine' },
                            { label: 'Panama', value: 'Panama' },
                            { label: 'Papua New Guinea', value: 'Papua New Guinea' },
                            { label: 'Paraguay', value: 'Paraguay' },
                            { label: 'Peru', value: 'Peru' },
                            { label: 'Philippines', value: 'Philippines' },
                            { label: 'Poland', value: 'Poland' },
                            { label: 'Portugal', value: 'Portugal' },
                            { label: 'Qatar', value: 'Qatar' },
                            { label: 'Romania', value: 'Romania' },
                            { label: 'Russia', value: 'Russia' },
                            { label: 'Rwanda', value: 'Rwanda' },
                            { label: 'Saint Kitts and Nevis', value: 'Saint Kitts and Nevis' },
                            { label: 'Saint Lucia', value: 'Saint Lucia' },
                            { label: 'Saint Vincent and the Grenadines', value: 'Saint Vincent and the Grenadines' },
                            { label: 'Samoa', value: 'Samoa' },
                            { label: 'San Marino', value: 'San Marino' },
                            { label: 'Sao Tome and Principe', value: 'Sao Tome and Principe' },
                            { label: 'Saudi Arabia', value: 'Saudi Arabia' },
                            { label: 'Senegal', value: 'Senegal' },
                            { label: 'Serbia', value: 'Serbia' },
                            { label: 'Seychelles', value: 'Seychelles' },
                            { label: 'Sierra Leone', value: 'Sierra Leone' },
                            { label: 'Singapore', value: 'Singapore' },
                            { label: 'Slovakia', value: 'Slovakia' },
                            { label: 'Slovenia', value: 'Slovenia' },
                            { label: 'Solomon Islands', value: 'Solomon Islands' },
                            { label: 'Somalia', value: 'Somalia' },
                            { label: 'South Africa', value: 'South Africa' },
                            { label: 'South Korea', value: 'South Korea' },
                            { label: 'South Sudan', value: 'South Sudan' },
                            { label: 'Spain', value: 'Spain' },
                            { label: 'Sri Lanka', value: 'Sri Lanka' },
                            { label: 'Sudan', value: 'Sudan' },
                            { label: 'Suriname', value: 'Suriname' },
                            { label: 'Sweden', value: 'Sweden' },
                            { label: 'Switzerland', value: 'Switzerland' },
                            { label: 'Syria', value: 'Syria' },
                            { label: 'Taiwan', value: 'Taiwan' },
                            { label: 'Tajikistan', value: 'Tajikistan' },
                            { label: 'Tanzania', value: 'Tanzania' },
                            { label: 'Thailand', value: 'Thailand' },
                            { label: 'Timor-Leste', value: 'Timor-Leste' },
                            { label: 'Togo', value: 'Togo' },
                            { label: 'Tonga', value: 'Tonga' },
                            { label: 'Trinidad and Tobago', value: 'Trinidad and Tobago' },
                            { label: 'Tunisia', value: 'Tunisia' },
                            { label: 'Turkey', value: 'Turkey' },
                            { label: 'Turkmenistan', value: 'Turkmenistan' },
                            { label: 'Tuvalu', value: 'Tuvalu' },
                            { label: 'Uganda', value: 'Uganda' },
                            { label: 'Ukraine', value: 'Ukraine' },
                            { label: 'United Arab Emirates', value: 'United Arab Emirates' },
                            { label: 'United Kingdom', value: 'United Kingdom' },
                            { label: 'United States', value: 'United States' },
                            { label: 'Uruguay', value: 'Uruguay' },
                            { label: 'Uzbekistan', value: 'Uzbekistan' },
                            { label: 'Vanuatu', value: 'Vanuatu' },
                            { label: 'Vatican City', value: 'Vatican City' },
                            { label: 'Venezuela', value: 'Venezuela' },
                            { label: 'Vietnam', value: 'Vietnam' },
                            { label: 'Yemen', value: 'Yemen' },
                            { label: 'Zambia', value: 'Zambia' },
                            { label: 'Zimbabwe', value: 'Zimbabwe' }
                                    ],
                                    options: [],
                                    isOpen: false,
                                    openedWithKeyboard: false,
                                    selectedOption: null,
                                    setSelectedOption(option) {
                                        this.selectedOption = option
                                        this.isOpen = false
                                        this.openedWithKeyboard = false
                                        this.$refs.hiddenTextField.value = option.value
                                    },
                                    getFilteredOptions(query) {
                                        this.options = this.allOptions.filter((option) =>
                                            option.label.toLowerCase().includes(query.toLowerCase()),
                                        )
                                        if (this.options.length === 0) {
                                            this.$refs.noResultsMessage.classList.remove('hidden')
                                        } else {
                                            this.$refs.noResultsMessage.classList.add('hidden')
                                        }
                                    },
                                    handleKeydownOnOptions(event) {
                                        // if the user presses backspace or the alpha-numeric keys, focus on the search field
                                        if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 48 && event.keyCode <= 57) || event.keyCode === 8) {
                                            this.$refs.searchField.focus()
                                        }
                                    },
                                }" class="flex w-full flex-col gap-1" x-on:keydown="handleKeydownOnOptions($event)"
      x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false" x-init="options = allOptions">
      <label for="country" class="w-fit pl-0.5 text-sm text-neutral-600 dark:text-neutral-300">Country</label>
      <div class="relative">
        <button type="button"
          class="inline-flex w-full items-center justify-between gap-2 border border-neutral-300 rounded-sm bg-neutral-50 px-4 py-2 text-sm font-medium tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black dark:border-neutral-700 dark:bg-neutral-900/50 dark:text-neutral-300 dark:focus-visible:outline-white"
          role="combobox" aria-controls="countryList" aria-haspopup="listbox" x-on:click="isOpen = ! isOpen"
          x-on:keydown.down.prevent="openedWithKeyboard = true" x-on:keydown.enter.prevent="openedWithKeyboard = true"
          x-on:keydown.space.prevent="openedWithKeyboard = true" x-bind:aria-expanded="isOpen || openedWithKeyboard"
          x-bind:aria-label="selectedOption ? selectedOption.value : 'Select'">
          <span class="text-sm font-normal" x-text="selectedOption ? selectedOption.value : 'Select'"></span>
          <i data-lucide="chevron-down" class="size-5" stroke-width="1.5"></i>
        </button>
        <input id="country" name="country" x-ref="hiddenTextField" hidden required />
        <div x-show="isOpen || openedWithKeyboard" id="countryList"
          class="absolute left-0 top-11 z-10 w-full overflow-hidden rounded-sm border border-neutral-300 bg-neutral-50 dark:border-neutral-700 dark:bg-neutral-900"
          role="listbox" aria-label="industries list" x-on:click.outside="isOpen = false, openedWithKeyboard = false"
          x-on:keydown.down.prevent="$focus.wrap().next()" x-on:keydown.up.prevent="$focus.wrap().previous()" x-transition
          x-trap="openedWithKeyboard">
          <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
              stroke-width="1.5"
              class="absolute left-4 top-1/2 size-5 -translate-y-1/2 text-neutral-600/50 dark:text-neutral-300/50"
              aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input type="text"
              class="w-full border-b border-neutral-300 bg-neutral-50 py-2.5 pl-11 pr-4 text-sm text-neutral-600 focus:outline-hidden focus-visible:border-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300 dark:focus-visible:border-white"
              name="searchField" aria-label="Search" x-on:input="getFilteredOptions($el.value)" x-ref="searchField"
              placeholder="Search" />
          </div>
          <ul class="flex max-h-44 flex-col overflow-y-auto">
            <li class="hidden px-4 py-2 text-sm text-neutral-600 dark:text-neutral-300" x-ref="noResultsMessage">
              <span>No matches found</span>
            </li>
            <template x-for="(item, index) in options" x-bind:key="item.value">
              <li
                class="combobox-option inline-flex justify-between gap-6 bg-neutral-50 px-4 py-2 text-sm text-neutral-600 hover:bg-neutral-900/5 hover:text-neutral-900 focus-visible:bg-neutral-900/5 focus-visible:text-neutral-900 focus-visible:outline-hidden dark:bg-neutral-900 dark:text-neutral-300 dark:hover:bg-neutral-50/5 dark:hover:text-white dark:focus-visible:bg-neutral-50/10 dark:focus-visible:text-white"
                role="option" x-on:click="setSelectedOption(item)" x-on:keydown.enter="setSelectedOption(item)"
                x-bind:id="'option-' + index" tabindex="0">
                <span x-bind:class="selectedOption == item ? 'font-bold' : null" x-text="item.label"></span>
                <span class="sr-only" x-text="selectedOption == item ? 'selected' : null"></span>
                <svg x-cloak x-show="selectedOption == item" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                  stroke="currentColor" fill="none" stroke-width="2" class="size-4" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5">
                </svg>
              </li>
            </template>
          </ul>
        </div>
      </div>
      @error('country')
        <small class="pl-0.5 text-red-500">{{ $message }}</small>
      @enderror
    </div>
    <div class="flex w-full flex-col gap-1 text-neutral-600">
      <label for="page_number" class="w-fit pl-0.5 text-sm">Page Number</label>
      <input id="page_number" type="text" value="{{ old('page_number') }}"
        class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
        name="page_number" accept="application/pdf" required />
      @error('page_number')
        <small class="pl-0.5 text-red-500">{{ $message }}</small>
      @enderror
    </div>
    <div class="flex w-full flex-col gap-1 text-neutral-600 dark:text-neutral-300">
      <label for="abstract" class="w-fit pl-0.5 text-sm">Abstract</label>
      <textarea id="abstract" name="abstract"
        class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2.5 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white"
        rows="3">{{ old('abstract') }}</textarea>
      @error('abstract')
        <small class="pl-0.5 text-red-500">{{ $message }}</small>
      @enderror
    </div>
    <div class="flex w-full flex-col gap-1 text-neutral-600">
      <label for="keyword" class="w-fit pl-0.5 text-sm">Keywords</label>
      <input id="keyword" type="text" value="{{ old('keyword') }}"
        class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
        name="keyword" required />
      @error('keyword')
        <small class="pl-0.5 text-red-500">{{ $message }}</small>
      @enderror
    </div>
    <div class="flex w-full flex-col gap-1 text-neutral-600">
      <label for="publication_date" class="w-fit pl-0.5 text-sm">Publication Date</label>
      <input id="publication_date" type="date" value="{{ old('publication_date') }}"
        class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
        name="publication_date" required />
      @error('publication_date')
        <small class="pl-0.5 text-red-500">{{ $message }}</small>
      @enderror
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