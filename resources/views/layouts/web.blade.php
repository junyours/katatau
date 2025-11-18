<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="{{ asset('images/icon.png') }}">
  <meta name="google-site-verification" content="2XyQMgn8Xz_5JVc5z57O-9Aj9VNKq4-Z5KMSv-WzJgg" />
  @yield('meta')

  <title>{{ config('app.name') }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{ loading: false }" x-init="
    window.addEventListener('beforeunload', () => loading = true);
    window.addEventListener('pageshow', () => loading = false);
  " class="text-slate-700 text-sm antialiased px-4">
  <x-ui.loader />
  @include('components.web.navbar')
  <main class="min-h-screen max-w-6xl mx-auto py-4">
    <div class="flex gap-8 max-md:flex-col">
      <div class="flex-1">
        @yield('content')
      </div>
      <div class="space-y-4 w-full md:w-xs">
        @include('components.web.archive')
        @include('components.web.indexing')
      </div>
    </div>
  </main>
  @include('components.web.footer')
  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    lucide.createIcons();
  </script>
</body>

</html>