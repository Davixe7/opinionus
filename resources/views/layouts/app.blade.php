<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <title>
    @if( $config = json_decode( Storage::get('/frontend-config.json' ) ) )
      {{ $config->brandname }}
    @else
      {{ config('app.name', 'Laravel') }}
    @endif
  </title>
  <script src="{{ mix('js/app.js') }}" defer></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @yield('head')
</head>
<body>
  <div id="app">
    <div class="circle-bg" style="background: lightblue; width: 25vw; height: 25vw; border-radius: 50%;position: absolute; bottom: 10px; right: 200px; z-index: 100;"></div>
    <div class="circle-bg" style="background: lightblue; width: 5vw; height: 5vw; border-radius: 50%;position: absolute; top: 90px; left: 230px; z-index: 100;"></div>
    <nav class="navbar navbar-expand-lg navbar-light mb-4">
      <a class="navbar-brand" href="{{ url('/') }}">
        @if( Storage::exists('/public/brand-logo.png') )
          <img src="/storage/brand-logo.png" alt="site logo">
        @endif
        @if( $config = json_decode( Storage::get('/frontend-config.json' ) ) )
          <div class="d-inline-block" style="vertical-align: middle; padding-left: 10px;">
            <span>{{ $config->brandname }}</span>
            <span class="navbar-catchphrase">{{ $config->catchphrase }}</span>
          </div>
        @else
          PollyPolls
        @endif
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          
          @if( Auth::check())
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('surveys.index') }}" class="nav-link">Surveys</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.surveys.index') }}" class="nav-link">Manage surveys</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.banners.index') }}" class="nav-link">Manage Banners</a>
          </li>
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" v-pre>
              Welcome, Admin <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
          </li>
          @else
            <li class="nav-item">
              <a href="{{ route('surveys.index') }}" class="nav-link">Surveys</a>
            </li>
          @endif
        </ul>
      </div>
    </nav>
    <main style="position: relative; z-index: 200;">
      <div class="container-fluid">
        @yield('content')
      </div>
    </main>
  </div>
  <footer>
    @yield('footer')
  </footer>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
</body>
</html>
