<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="{{ mix('css/new.css') }}">
  </head>
  <body>
    @include('partials.menu')
    <div class="navbar">
      <button class="btn btn-navbar-action"
        onclick="document.querySelector('#absolute-menu').classList.add('active')">
        <i class="op-icon menu"></i>
      </button>
      <img src="{{ asset('logo.png') }}" alt="Site logo" class="navbar-brand">
      <a class="btn btn-navbar-action ml-auto" href="/search">
        <i class="op-icon search"></i>
      </a>
    </div>
    <main>
      <div class="container">
        <article >
          <div class="home-headline">
            <h1>{{ $frontend_config->headline }}</h1>
            <p>{{ $frontend_config->description }}</p>
          </div>
        </article>
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
          <div class="card home-survey">
            <div class="card-title">{{ $survey->name }}</div>
            <div class="choices">
              @foreach( $survey->choices as $choice )
                <div class="choice-thumbnail">
                  <img src="{{ $choice->picture }}" alt="{{$choice->name}}">
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

        @include('partials.footer-navbar')
      </div>
    </main>

    <script>
      var fixed = document.getElementById('absolute-menu');
        fixed.addEventListener('touchmove', function(e) {
        e.preventDefault();
      }, false);
    </script>
  </body>
</html>
