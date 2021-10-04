<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
      <h1 class="logo mr-auto"><a href="{{url('/')}}">
          <img src="{{ asset('logo.png') }}" class="img-fluid" alt="logo">
      </a></h1>
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="{{url()->current() == url('/') ? 'active' : ''}}"><a href="{{ url('/') }}">Home</a></li>
          <li class="{{url()->current() == url('/about-us') ? 'active' : ''}}"><a href="{{ url('/about-us') }}">About Us</a></li>
          <li class="{{url()->current() == url('/privacy-policy') ? 'active' : ''}}"><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
          <li class="{{url()->current() == url('/terms-conditions') ? 'active' : ''}}"><a href="{{ url('/terms-conditions') }}">Terms & Conditions</a></li>
        </ul>
      </nav><!-- .nav-menu -->
      @if (Auth::check())
      <a href="{{ url('/home') }}" class="get-started-btn scrollto">DashBoard</a>
      @else
      <a href="{{ url('/login') }}" class="get-started-btn scrollto">Log In</a>
      <a href="{{ url('/register') }}" class="get-started-btn scrollto">Sign Up</a>
      @endif
    </div>
  </header>
