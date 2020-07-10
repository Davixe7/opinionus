<nav class="surveys-navbar">
  <button class="navbar-nav-toggler btn btn-navbar" data-target="#navbar-nav-tile">
    <i class="material-icons">menu</i>
  </button>
  @if( isset($page_title) )  
    <span class="navbar-title">{{ $page_title }}</span>
  @else
    <a href="/" class="surveys-navbar-brand">
      <img src="/logo.png" alt="">
    </a>
  @endif
  <div class="ml-auto">
    @if( Route::currentRouteName() != 'landing' && url()->current() != url()->previous() )
    <a href="{{ url()->previous() }}" class="btn btn-navbar">
      <i class="material-icons">keyboard_backspace</i>
    </a>
    @endif
    <a href="{{ route('search') }}" class="btn btn-navbar">
      <i class="material-icons">search</i>
    </a>
  </div>
  
  <div id="navbar-nav-tile" class="navbar-nav-tile">
    <div class="header">
      <button class="btn btn-outlined-default" onclick="document.querySelector('.navbar-nav-tile').classList.remove('active');">
        <i class="material-icons">close</i>
      </button>
    </div>
    <ul class="surveys-navbar-nav mb-4">
      <li><a href="/">HOME</a></li>
      <li><a href="#">Categories</a></li>
      <li><a href="{{ route('surveys.index') }}">Surveys</a></li>
      <li><a href="{{ route('search') }}">Search</a></li>
      <li><a href="#">Help</a></li>
    </ul>
    <ul class="surveys-navbar-nav mt-4">
      <li><a href="{{ route('login') }}">Login</a></li>
      <li><a href="{{ route('register') }}">Signup</a></li>
    </ul>
  </div>
</nav>