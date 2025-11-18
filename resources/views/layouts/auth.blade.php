<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/x-icon" href="{{ asset('images/icon.png') }}">

  <title>{{ config('app.name') }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 antialiased">
  <div class="min-h-screen flex items-center justify-center">
    <div class="flex w-full rounded-sm max-w-sm flex-col border border-neutral-300 bg-neutral-50 text-neutral-600">
      <div class="flex flex-col gap-4 p-6">
        <a href={{ route('home') }} class="p-2">
          <img src={{ asset('images/logo.png') }} class="object-contain" alt="logo" />
        </a>
        @yield('content')
      </div>
    </div>
  </div>
  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    lucide.createIcons();
  </script>
</body>

</html>