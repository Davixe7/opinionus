<div id="absolute-menu">
  <button class="btn btn-close" onclick="document.querySelector('#absolute-menu').classList.remove('active')">
    <i class="op-icon close"></i>
  </button>
  <ul>
    <li><a href="{{ route('home') }}">HOME</a></li>
    <li><a href="#">Categories</a></li>
    <li><a href="{{ route('search') }}">Surveys</a></li>
    <li><a href="{{ route('search') }}">Search</a></li>
    <li><a href="#">Help</a></li>

    <li style="margin-top: 60px;"><a href="/login">Login</a></li>
    <li><a href="/register">Sign Up</a></li>
  </ul>
</div>
