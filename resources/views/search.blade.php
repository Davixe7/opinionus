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
  <link rel="stylesheet" href="/css/app.css">
  <style>
    .footer {
      padding: 50px 0;
      height: 25vh;
    }
    
    .surveys-searchform {
      position: relative;
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }
    .surveys-searchform .search-icon {
      position: absolute;
      right: 10px;
      bottom: 5px;
    }
    .search-input-wrap {
      flex: 1 1 auto;
      margin-right: 10px;
      position: relative;
    }
    .surveys-searchform input[type=search] {
      width: 100%;
      height: 48px;
      padding: 0 20px;
      border: none;
      border-radius: 10px;
      background: #fff;
    }
    .surveys-searchform input[type=search]::placeholder {
      font-size: 12px;
      font-weight: 600;
      color: #828282;
    }
  </style>
</head>
<body>
  <div id="app">
    <div class="header">
      @include('partials.navbar', ['page_title'=>$page_title])
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="surveys-searchform">
          <div class="search-input-wrap">
            <input type="search" placeholder="Type your keyboard">
            <span class="search-icon"><i class="material-icons">search</i></span>
          </div>
          <button class="btn bg-white btn-filters"><i class="material-icons">tune</i></button>
        </div>
        
        <div class="material-list-wrapper">
          <span class="component-title">28 results</span>
          <div class="material-list-underline"></div>
          <ul class="material-list">
            <li class="active"><a href="#">Results</a></li>
          </ul>
        </div>
        
        <div class="polls-container">
          @foreach($surveys as $survey)
          <div class="poll-content mb-2">
            <div class="card card-body pb-0">
              <div class="survey-content">
                <div class="poll-name">{{ $survey->name }}</div>
                <div class="poll-votes-count">
                  {{ $survey->votes_count }}
                </div>
                <div class="poll-prefooter">
                  <span>5 June 2020</span>
                  <span>21 Days Left</span>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    
    @include('partials.footer-navbar')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.7.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
      const underline = $('.material-list-underline').first();
      var activeTabLink = $('.material-list li.active').first()[0]
      underline.css({
        right: activeTabLink.offsetParent.clientWidth - (activeTabLink.offsetLeft + activeTabLink.clientWidth) + 'px',
        left : activeTabLink.offsetLeft + 'px'
      })
      $('.material-list a').click(function(e){
        e.preventDefault();
      })
      $('.material-list li').click(function(){
        underline.css({
          right: this.offsetParent.clientWidth - (this.offsetLeft + this.clientWidth) + 'px',
          left : this.offsetLeft + 'px'
        })
      });
      
      $('.navbar-nav-toggler').click(function(){
        let target = $(this).data('target')
        $(target).addClass('active');
      });
    </script>
  </div>
</body>
</html>