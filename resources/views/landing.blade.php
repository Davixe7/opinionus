<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Polly</title>
  <script src="{{ mix('js/app.js') }}" defer></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,600,700,900&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  
  <!-- Styles -->
  <style>
    html, body {
      background-color: #fff;
      color: #636b6f;
      font-family: 'Roboto', sans-serif;
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
  </style>
</head>
<body>
  <div id="app">
    <div class="circle-bg" style="background: lightblue; width: 25vw; height: 25vw; border-radius: 50%;position: absolute; bottom: 10px; right: 200px; z-index: 100;"></div>
    <div class="circle-bg" style="background: lightblue; width: 5vw; height: 5vw; border-radius: 50%;position: absolute; top: 90px; left: 230px; z-index: 100;"></div>
    <main>
      <landing :surveys="{{ json_encode($surveys) }}"/>
    </main>
  </div>
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/brands.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
</body>
</html>
