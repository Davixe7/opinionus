<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <title>
    {{ $siteconfig->brandname }}
  </title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/app.css">
  <style>
    h1 {
      font-size: 36px;
      font-weight: 700;
      position: relative;
      text-transform: capitalize;
      margin-bottom: 20px;
    }
    p {
      font-weight: 600;
    }
    .footer {
      padding: 50px 0;
      height: 25vh;
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
    <div class="header">
      @include('partials.navbar')
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-5 text-left" style="padding-top: 65px; padding-bottom: 65px;">
          <h1>{{ $siteconfig->headline }}</h1>
          <p>{{ $siteconfig->description }}</p>
        </div>
        <div class="col-md-7">
          <div class="material-list-wrapper">
            <span class="component-title">Top 10 surveys</span>
            <div class="material-list-underline"></div>
            <ul class="material-list">
              <li class="active"><a href="#">Latest</a></li>
            </ul>
          </div>
          <div class="polls-container">
            @foreach($surveys as $survey)
            <div class="poll-content px-2">
              <div class="card card-body">
                <div class="survey-content">
                  <div class="poll-name">{{ $survey->name }}</div>
                  <ul class="poll-candidates">
                    @foreach($survey->choices as $choice)
                      <li style="background-image: url({{ str_replace('public', 'storage', $choice->image) }})" class="poll-canditate"></li>
                    @endforeach
                  </ul>
                  <div class="poll-votes-count">
                    {{ $survey->votes_count }}
                  </div>
                  <div class="poll-prefooter">
                    <span>{{ $survey->f_created_at }}</span>
                    <span>21 Days Left</span>
                  </div>
                  <div class="poll-actions">
                    <a href="/surveys/{{$survey->slug}}/results" class="btn btn-secondary">See results</a>
                    <a href="/surveys/{{$survey->slug}}/vote" class="btn btn-primary btn-cta-vote">Vote</a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    
    @include('partials.footer-navbar')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.7.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
      $(document).ready(function(){
        const underline = $('.material-list-underline').first()
        var activeTabLink = $('.material-list li.active').first()[0]
        
        underline.css({
          right: activeTabLink.offsetParent.clientWidth - (activeTabLink.offsetLeft + activeTabLink.clientWidth) + 'px',
          left : activeTabLink.offsetLeft + 'px'
        })
        
        $('.material-list a').click(function(e){
          e.preventDefault()
        })
        $('.material-list li').click(function(){
          underline.css({
            right: this.offsetParent.clientWidth - (this.offsetLeft + this.clientWidth) + 'px',
            left : this.offsetLeft + 'px'
          })
        })
        
        $('.polls-container').slick({
          autoplay: true,
          autoplaySpeed: 2000,
          infinite: true,
          slidesToShow: 2,
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
            breakpoint: 576,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          }]
        })
        
        $('.navbar-nav-toggler').click(function(){
          let target = $(this).data('target')
          $(target).addClass('active')
        })
        
      })
    </script>
  </div>
</body>
</html>