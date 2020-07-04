<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon.png">
  <title>{{ json_decode( $siteconfig )->brandname }}</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,600,700,900&display=swap" rel="stylesheet"> -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <style>
    html, body {
      background-color: #fff;
      color: #636b6f;
      font-family: 'Montserrat', sans-serif;
      font-weight: 200;
      height: 100vh;
      margin: 0;
    }
    .full-height {
      height: 100vh;
    }
    .flex-center {
      align-items: center;
      display: flex;
      justify-content: center;
    }
    .position-ref {
      position: relative;
    }
    .top-right {
      position: absolute;
      right: 10px;
      top: 18px;
    }
    .content {
      text-align: center;
    }
    .title {
      font-size: 84px;
    }
    .links > a {
      color: #636b6f;
      padding: 0 25px;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: .1rem;
      text-decoration: none;
      text-transform: uppercase;
    }
    .m-b-md {
      margin-bottom: 30px;
    }
    .landing-navbar {
      display: flex;
    }
    .landing-navbar .navbar-nav {
      display: flex;
      flex-flow: column nowrap;
      margin-left: auto;
    }
    .landing-navbar .navbar-nav li a {
      font-weight: 600;
      text-align: right;
      display: block;
      font-size: 1.15em;
    }
    @media (min-width: 991px) {
      .landing-navbar {
        align-items: center;
      }
      .landing-navbar .navbar-nav {
        display: flex;
        flex-flow: row nowrap;  
      }
      .landing-navbar .navbar-nav li {
        margin-right: 25px;
      }
    }
  </style>
</head>
<body>
  <div id="app">
    <div class="circle-bg" style="background: lightblue; width: 25vw; height: 25vw; border-radius: 50%;position: absolute; bottom: 10px; right: 200px; z-index: 100;"></div>
    <div class="circle-bg" style="background: lightblue; width: 5vw; height: 5vw; border-radius: 50%;position: absolute; top: 90px; left: 230px; z-index: 100;"></div>
    <main>
      <landing :surveys="{{ json_encode($surveys) }}" :siteconfig="{{ $siteconfig }}"/>
    </main>
  </div>
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/brands.min.css" rel="stylesheet">
  <script src="{{ mix('js/app.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
</body>
</html>
