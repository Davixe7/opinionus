<div class="navbar">
  <button class="btn btn-navbar-action"
    onclick="document.querySelector('#absolute-menu').classList.add('active')">
    <i class="op-icon menu"></i>
  </button>
  <img src="{{ asset('logo.png') }}" alt="Site logo" class="navbar-brand">
  <a href="{{ route('home') }}" class="btn btn-navbar-action ml-auto">
    <i class="op-icon arrow-left"></i>
  </a>
</div>
