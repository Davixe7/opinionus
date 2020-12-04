<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <title>
    @if( $config = json_decode( Storage::get('frontend-config.json' ) ) )
      {{ $config->brandname }}
    @else
      {{ config('app.name', 'Laravel') }}
    @endif
  </title>
  <script src="{{ mix('js/app.js') }}" defer></script>
  <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  @yield('head')
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-lg navbar-light mb-4">
      <a class="navbar-brand" href="{{ url('/') }}">
        @if( Storage::exists('public/brand-logo.png') )
          <img src="/storage/brand-logo.png" alt="site logo" style="max-width: 120px;">
        @elseif( $config = json_decode( Storage::get('frontend-config.json' ) ) )
          <div class="d-inline-block" style="vertical-align: middle; padding-left: 10px;">
            <span>{{ $config->brandname }}</span>
            <span class="navbar-catchphrase">{{ $config->catchphrase }}</span>
          </div>
        @else
          OpinionUS
        @endif
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          @if( Auth::guard('web')->check() )
          <li class="nav-item">
            <a href="{{ route('dashboard.index') }}" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('dashboard.surveys.index') }}" class="nav-link">Manage surveys</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('dashboard.banners.index') }}" class="nav-link">Manage Banners</a>
          </li>
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" v-pre>
              Welcome, {{Auth::user()->name}} <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
          </li>
          @elseif( Auth::guard('admin')->check() )
          <li class="nav-item">
            <a href="/home" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link">Users</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.admin-banners.index') }}" class="nav-link">Admin Banners</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.reports.index') }}" class="nav-link">Reports</a>
          </li>
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" v-pre>
              Welcome, {{Auth::guard('admin')->user()->name}} <span class="caret"></span>
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
</body>
</html>
