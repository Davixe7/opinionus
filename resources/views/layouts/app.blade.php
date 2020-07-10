<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <title>
    {{ $siteconfig->brandname }}
  </title>
  <script src="{{ mix('js/app.js') }}" defer></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @yield('head')
</head>
<body>
  <div id="app">
    @include('partials.navbar')
    <main>
      <div class="container-fluid mb-3">
        @yield('content')
      </div>
    </main>
    <footer class="px-3">
      @include('partials.footer-navbar')
      @yield('footer')
    </footer>
  </div>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
</body>
</html>
