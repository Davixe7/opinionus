<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('APP_NAME', 'OpinionUS') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/new.css') }}">
    <style>
        body {
            background: url("{{ asset('background.png') }}");
            background-position: center;
            background-repeat: no-repeat;
            background-color: #f3f3f3;
        }
        @media(min-width: 991px){
            #landing-page {
                overflow: hidden;
            }
            .row {
                margin: 0 -20px;
            }
            .col-lg-5, .col-lg-7 {
                padding: 0 20px;
            }
            #landing-page .col-lg-5 {
                flex: 1 0 42%;
            }
            .home-surveys {
                max-width: 100%;
                overflow: auto;
                justify-content: initial;
            }
            .home-survey {
                flex: 0 0 380px;
                box-sizing: border-box;
                overflow: hidden;
            }
            .home-survey .card-title {
                padding-top: 0;
                margin-top: 0;
            }
            .choice-thumbnail {
                flex: 0 0 68px;
            }
            .col-lg-5 {
                flex: 1 1 41.6%;
            }
            .col-lg-7 {
                flex: 1 1 58.3%;
            }
        }
    </style>
  </head>
  <body>
    @include('partials.menu')
    <div class="navbar">
      <button class="btn btn-navbar-action"
        onclick="document.querySelector('#absolute-menu').classList.add('active')">
        <i class="op-icon menu"></i>
      </button>
      <img src="{{ asset('logo.png') }}" alt="Site logo" class="navbar-brand">
      <a class="btn btn-navbar-action ml-auto" href="{{ route('search') }}">
        <i class="op-icon search"></i>
      </a>
    </div>
    <main>
      <div class="container" id="landing-page">
        <div class="row">
          <div class="col-lg-5">
            <article >
              <div class="home-headline">
                <h1>{{ $frontend_config->headline }}</h1>
                <p>{{ $frontend_config->description }}</p>
              </div>
            </article>
          </div>
          <div class="col-lg-7">
            <div class="section-title">
              <span class="title">
                Latest
              </span>
              <span class="detail">
                Top 10 Surveys
              </span>
            </div>
            <div class="home-surveys">
              @foreach($surveys as $survey)
              <div class="card home-survey @if($survey->is_expired) expired @endif">
                <div class="card-title">{{ $survey->name }}</div>
                <div class="choices">
                  @foreach( $survey->choices as $choice )
                    <div class="choice-thumbnail">
                      <img src="{{ asset( str_replace('images', 'thumbnails/70', $choice->picture) ) }}" alt="{{$choice->name}}">
                    </div>
                  @endforeach
                </div>
                <div class="votes-count">
                  {{ $survey->votes_count }}
                </div>
                <div class="dates">
                  <div>{{ $survey->created_date }}</div>
                  <div>{{ $survey->days_left }}</div>
                </div>
                <div class="card-actions">
                  <a href="{{ route('surveys.results', ['slug'=>$survey->slug]) }}" class="btn">See Results</a>
                  <a href="{{ route('surveys.vote', ['slug'=>$survey->slug]) }}" class="btn btn-primary ml-auto">
                    <i class="op-icon ballot"></i>
                    Vote
                  </a>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        @include('partials.footer-navbar')
      </div>
    </main>

    <script>
      var fixed = document.getElementById('absolute-menu');
        fixed.addEventListener('touchmove', function(e) {
        e.preventDefault();
      }, false);
    </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&amp;display=swap">
  </body>
</html>
