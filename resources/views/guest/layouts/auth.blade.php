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
  {{-- Alerts untuk auth (status / error / validation) --}}
  @if(session('status'))
    <div class="fixed top-4 right-4 z-50">
      <div class="alert alert-success shadow-lg">
        <div>
          <span>{{ session('status') }}</span>
        </div>
      </div>
    </div>
  @endif

  @if(session('error'))
    <div class="fixed top-4 right-4 z-50">
      <div class="alert alert-error shadow-lg">
        <div>
          <span>{{ session('error') }}</span>
        </div>
      </div>
    </div>
  @endif

  @if ($errors->any())
    <div class="fixed top-4 right-4 z-50 max-w-sm">
      <div class="alert alert-error shadow-lg">
        <div>
          <div>
            <strong class="font-bold">Terjadi kesalahan</strong>
            <ul class="mt-2 list-disc pl-5 text-sm">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  @endif

  @yield('document.body')

  @yield('document.end')
</body>

</html>