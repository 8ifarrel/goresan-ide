<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="goresan_ide">

<head>
  <meta charset="utf-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <meta name="description" content="{{ $page_meta_description }}" />

  <title>
    {{ $page_title ? $page_title . ' |' : '' }} {{ config('app.name', 'Laravel') }}
  </title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  @vite('resources/css/app.css')

  @yield('document.head')
</head>

<body>
  {{-- Global success alert (auth/status) --}}
  @if (session('success') || session('status'))
    <div id="global-success-alert" class="fixed top-4 right-4 z-50">
      <div class="alert alert-success shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('success') ?? session('status') }}</span>
      </div>
    </div>

    <script>
      // auto-dismiss alert after 5s
      setTimeout(function() {
        const el = document.getElementById('global-success-alert');
        if (el) el.remove();
      }, 5000);
    </script>
  @endif

  @include('guest.components.navbar')

  @yield('document.body')

  @include('guest.components.footer')

  @yield('document.end')
</body>

</html>
