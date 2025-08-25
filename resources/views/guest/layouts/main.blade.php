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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  @vite('resources/css/app.css')

  @yield('document.head')
</head>

<body>
  @include('guest.components.navbar')

  @yield('document.body')

  @include('guest.components.footer')

  @yield('document.end')
</body>

</html>