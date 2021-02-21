<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="/favicon.png">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('APP_NAME', 'OpinionUS') }}</title>
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link href="{{ asset('css/new.css') }}" rel="stylesheet">
  @yield('head')
</head>
<body>
  <div id="app">
    @include('partials.menu')
    <header>
      @include('partials.navbar')
    </header>
    <main>
      <div class="container">
        @yield('content')
      </div>
    </main>
    <footer>
      @include('partials.footer-navbar')
    </footer>
  </div>
  <script>
    var fixed = document.getElementById('absolute-menu');
      fixed.addEventListener('touchmove', function(e) {
      e.preventDefault();
    }, false);
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</body>
</html>
