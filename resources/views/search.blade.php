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
      display: flex;
      align-items: center;
      position: relative;
      margin-bottom: 20px;
    }
    .surveys-searchform .btn-search{
      position: absolute;
      right: 10px;
      bottom: 5px;
      border: none;
      background: #fff;
      cursor: pointer;
      user-select: none;
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
    .searchform-filter-btn {
      background: #fff;
    }
    .searchform-filter-btn[data-shown=true]{
      background: #0060EF;
      color: #fff;
    }
    #search-form-filter {
      display: block;
      width: 100%;
      padding: 20px;
      border-radius: 10px;
      background: #fff;
      box-shadow: 0 1px 10px 1px rgba(0,0,0,.2);
    }
    #search-form-filter .title {
      display: block;
      font-size: 12px;
      font-weight: 600;
      color: #000;
      margin: 0 10px 12px 0;
    }
    .form-group label {
      font-weight: 600;
      margin: 0;
    }
    .date-filter {
      display: flex;
      flex-flow: row nowrap;
    }
    .date-filter .form-group {
      flex: 1 1 50%;
    }
    .date-filter .form-group:first-child {
      padding-right: 10px;
    }
    .date-filter label {
      display: inline-block;
      font-weight: 300;
      color: #d4d4d4;
      margin-right: 10px;
    }
    .date-filter input[type=date]{
      display: inline-block;
      width: auto;
      font-size: 12px;
      border-radius: 10px;
      background: #d4d4d4;
    }
  </style>
</head>
<body>
  <div id="app">
    <div class="header">
      @include('partials.navbar', ['page_title'=>'Search'])
    </div>
    <div class="row">
      <div class="col-md-12">
        <form id="search-form" action="{{ route('search') }}" method="GET">
        <div class="surveys-searchform">
          <div class="search-input-wrap">
            <input type="search" placeholder="Type your keyboard" name="name">
            <span class="btn-search" onclick="document.querySelector('#search-form').submit()"><i class="material-icons">search</i></span>
          </div>
          <button id="searchform-filter-btn" type="button" class="btn searchform-filter-btn" data-shown="false">
            <i class="material-icons">tune</i>
          </button>
        </div>
        <div id="search-form-filter" class="@if( !$errors->any() ) d-none @endif">
          <span class="title">Apply filter to search:</span>
          <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" value="1" id="show-outdated-input">
            <label class="form-check-label" for="show-outdated-input">
              Show Outdated Surveys
            </label>
          </div>
          <span class="title">Filter By Date</span>
          <div class="date-filter">
            <div class="form-group">
              <label class="d-inline-block">From</label>
              <input type="date" class="form-control @error('date_from') is-invalid @enderror" name="date_from">
              @error('date_from')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <label class="d-inline-block">To</label>
              <input type="date" class="form-control @error('date_to') is-invalid @enderror" name="date_to">
              @error('date_to')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
        </div>
        </form>
        
        <div class="material-list-wrapper">
          <span class="component-title">{{ count($surveys) ?: 0 }} results</span>
          <div class="material-list-underline"></div>
          <ul class="material-list">
            <li class="active"><a href="#">Results</a></li>
          </ul>
        </div>
        
        <div class="polls-container">
          @foreach($surveys as $survey)
          <div class="poll-content mb-2">
            <a href="/surveys/{{ $survey->slug }}/vote">
              <div class="card card-body pb-0">
                <div class="survey-content">
                  <div class="poll-name">{{ $survey->name }}</div>
                  <div class="poll-votes-count">
                    {{ $survey->votes_count }}
                  </div>
                  <div class="poll-prefooter">
                    <span>{{ $survey->f_created_at }}</span>
                    <span>21 Days Left</span>
                  </div>
                </div>
              </div>
            </a>
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
      
      const filterBtn     = $('#searchform-filter-btn');
      const filterBtnIcon = filterBtn.find('i.material-icons')
      
      filterBtn.click(function(){
        $(this).toggleClass('bg-primary text-white')
        $('#search-form-filter').toggleClass('d-none')
      });
    </script>
  </div>
</body>
</html>