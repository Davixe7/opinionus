<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <title>
    @if( $config = json_decode( Storage::get('/frontend-config.json' ) ) )
      {{ $config->brandname }}
    @endif
  </title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
  <style>
    #app {
      font-family: 'Montserrat', sans-serif;
      font-size: 14px;
      color: #1e1e1e;
      padding: 10px 20px;
      background: #f4f6f9;
      min-height: 100vh;
    }
    .navbar {
      padding: 20px 15px;
      border-bottom: 1px solid #efefef;
      border-radius: 5px;
      background: #fff;
      position: sticky;
      top: 15px;
      z-index: 999;
    }
    .navbar-brand {
      font-size: 1.25em;
      font-weight: 700;
      padding-left: 0;
    }
    .navbar .navbar-nav .nav-item .nav-link {
      font-weight: 600;
      padding: 5px 20px;
    }
    .navbar-catchphrase {
      font-weight: 400;
      font-size: 0.75em;
      max-width: 100px;
      display: block;
    }
    .survey-content {
      overflow: hidden;
    }
    .poll-name,.poll-content-number {
      font-size: 1.5em;
      line-height: 1em;
      font-weight: 700 !important;
      margin-bottom: 15px;
      color: #7f7f7f;
    }
    .poll-candidates {
      list-style-type: none;
      display: flex;
      justify-content: flex-start;
      padding: 0;
    }
    .poll-candidates li {
      margin-right: 5px;
      border-radius: 5%;
      height: 50px;
      width: 50px;
      border: 2px solid #fff;
      flex: 0 0 50px;
      background-size: cover;
    }
    .poll-footer {
      display: flex;
      align-items: center;
    }
    .label-small {
      font-size: .70em;
      font-weight: 400;
      text-transform: uppercase;
      margin-bottom: 0;
    }
    h1 {
      font-size: 5.14em;
      font-weight: 700;
      position: relative;
    }
    h1:before {
      display: block;
      font-size: 14px;
      font-weight: 400;
      content: 'Welcome to';
      width: 100%;
    }
    p {
      font-weight: 400;
    }
    .footer {
      padding: 50px 0;
      height: 25vh;
    }
    .card {
      color: #434343;
      border-radius: 5px;
      background: none;
      overflow: hidden;
    }
    .card-body {
      padding: 20px 20px 0;
    }
    .content {
      padding: 50px 0;
      position: relative;
      z-index: 101;
    }
  </style>
</head>
<body>
  <div id="app">
    <div class="circles">
      <div class="circle-bg" style="background: lightblue; width: 25vw; height: 25vw; border-radius: 50%;position: absolute; bottom: 10px; right: 200px; z-index: 100;"></div>
      <div class="circle-bg" style="background: lightblue; width: 5vw; height: 5vw; border-radius: 50%;position: absolute; top: 90px; left: 230px; z-index: 100;"></div>
    </div>
    <div class="header">
      <nav class="navbar navbar-expand-lg navbar-light mb-4">
        <a class="navbar-brand" href="{{ url('/') }}">
          <img src="/logo.png" alt="opinion-us-logo" style="width: 150px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            {{-- @if( Auth::check() ) --}}
            @if( false )
              <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
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
              <a href="/" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('surveys.index') }}" class="nav-link">Surveys</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('surveys.index') }}" class="nav-link">Make a Survey</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('surveys.index') }}" class="nav-link">Search</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('surveys.index') }}" class="nav-link">Help</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('login') }}" class="nav-link">Login</a>
            </li>
            @endif
          </ul>
        </div>
      </nav>
    </div>
    
    <div class="content">
      <div class="row">
        <div class="col-md-5 text-left">
          <h1>{{ $config->headline }}</h1>
          <p>{{ $config->description }}</p>
          <a href="/surveys" class="btn btn-primary btn-lg mb-3">See all Surveys</a>
        </div>
        <div class="col-md-7">
          <div class="polls-container">
            @foreach($surveys as $survey)
            <div class="poll-content px-2">
              <div class="card card-body">
                <div class="survey-content">
                  <div class="label-small">Survey name</div>
                  <div class="poll-name">{{ $survey->name }}</div>
                  <ul class="poll-candidates">
                    @foreach($survey->choices as $choice)
                      <li style="background-image: url({{ str_replace('public', 'storage', $choice->image) }})" class="poll-canditate"></li>
                    @endforeach
                  </ul>
                  <div class="poll-footer">
                    <div>
                      <div class="label-small">votes</div>
                      <div class="poll-content-number">{{ $survey->votes_count }}</div>
                    </div>
                    <a href="/surveys/{{$survey->slug}}/vote" class="ml-auto btn btn-primary btn-sm">
                      Take Survey
                    </a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    
    <footer class="footer">
      <div class="row">
        <div class="col-md-4">
          <div class="copyright">
            <h4>{{ $config->brandname }}</h4>
            &copy; All rights reserved {{ $config->brandname }} 2020 <br>
            United States
          </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
          {{-- <ul class="socials">
            <li>
              <a class="fab">
                <span class="fab fa-facebook-square"></span>
              </a>
            </li>
            <li>
              <a class="fab">
                <span class="fab fa-twitter"></span>
              </a>
            </li>
            <li>
              <a class="fab">
                <span class="fab fa-instagram"></span>
              </a>
            </li>
          </ul> --}}
        </div>
      </div>
    </footer>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.7.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
      $('.polls-container').slick({
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: false,
        responsive:[
        {
          breakpoint: 1028,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 867,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          }
        }]
      });
    </script>
  </div>
</body>
</html>