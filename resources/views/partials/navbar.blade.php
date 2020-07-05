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
  <button class="btn btn-navbar ml-auto">
    <i class="material-icons">keyboard_backspace</i>
  </button>
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