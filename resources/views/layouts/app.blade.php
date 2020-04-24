<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>{{ config('app.name', 'Laravel') }}</title>
  
  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>
  
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <!-- Styles -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,600,700&display=swap" rel="stylesheet">
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-4">
      <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse">
        <div class="navbar-nav">
          <li class="nav-item">
            <a href="{{ route('surveys.index') }}" class="nav-link">Surveys</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('banners.index') }}" class="nav-link">Banners</a>
          </li>
        </div>
      </div>
    </nav>
    <main>
      <div class="container-fluid">
        @yield('content')
      </div>
    </main>
  </div>
  <footer>
    @yield('footer')
  </footer>
</body>
</html>
