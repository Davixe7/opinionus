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
  <title>{{ config('app.name', 'Laravel') }}</title>
  <script src="{{ mix('js/app.js') }}" defer></script>
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,500,600,700&display=swap" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
        @if( $config = json_decode( Storage::get('public/frontend-config.json' ) ) )
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
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
  <!-- <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ea225ac6489781d"></script> -->
  
  <!-- AddThis overriding styles -->
  <style>
    @media(min-width: 992px){
      #at4-share {
        top: 25% !important;
      }
    }
    @media(max-width: 991px){
      .at-share-dock.atss {
        top: 28%;
        left: 0;
        right: auto;
        bottom: auto !important;
        width: 40px !important;
        max-width: 40px !important;
        z-index: 1000200;
        box-shadow: 0 0 1px 1px #e2dfe2;
        height: auto !important;
      }
      .at-share-btn,.at4-count {
        width: 40px !important;
      }
    }
  </style>
</body>
</html>
