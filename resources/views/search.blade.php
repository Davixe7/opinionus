<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/new.css') }}">
  </head>
  <body>
    @include('partials.menu')
    <div class="navbar">
      <button class="btn btn-navbar-action"
        onclick="document.querySelector('#absolute-menu').classList.add('active')">
        <i class="op-icon menu"></i>
      </button>
      <div class="navbar-brand">Search</div>
      <a href="{{ route('home') }}" class="btn btn-navbar-action ml-auto ml-auto">
        <i class="op-icon arrow-left"></i>
      </a>
    </div>

    <main>
      <div class="container">
        <form action="{{ route('search') }}" method="GET">
        <div class="search-form">
          <div class="input-group">
            <input type="search" placeholder="Type your keyboard" name="name">
            <button class="btn" type="submit">
              <i class="op-icon search"></i>
            </button>
          </div>
          <button class="btn" type="button">
            <i class="op-icon tweak"></i>
          </button>
          </form>
        </div>

        <div class="section-title">
          <div class="title">Results</div>
          <div class="detail">{{ $results->count() }} Results</div>
        </div>

        <div class="search-results">
          @foreach( $results as $result )
          <div class="card search-result"
              onclick="window.location.href = '{{ route('surveys.vote', ['slug'=>$result->slug]) }}'">
            <div class="card-title">{{ $result->name }}</div>
            <div class="votes-count">
              {{ $result->votes_count }}
            </div>
            <div class="dates">
              <div>{{ $result->created_date }}</div>
              <div>{{ $result->days_left }}</div>
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
