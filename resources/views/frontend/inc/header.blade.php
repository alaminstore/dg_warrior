<header id="header" class="fixed-top">
<style>
.goog-logo-link {display:none !important;}
.goog-te-gadget {color: transparent !important;padding: 0!important;margin:0!important;font-size: 0px!important;}
.goog-te-banner-frame.skiptranslate {display: none !important;}
#google_translate_element select{
 background-color:#f6edfd;
 color:#383ffa;
 border: none;
 border-radius:3px;
 padding:0;
 cursor: pointer;
 }
</style>
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
          <li><a id="google_translate_element"  data-toggle="tooltip" data-placement="bottom" title="Select Which language you want to convert"></a></li>
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
