<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title','DG Warrior')</title>
  <!-- Favicons -->
  <link href="{{ asset('logo.svg') }}" rel="icon">
  <link href="{{ asset('frontend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Krub:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link href="{{ asset('frontend/assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('backend/assets/js/jquery-toast-plugin/jquery.toast.min.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Template Main CSS File -->
  <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">
  <style>.clr{clear:both;}</style>
</head>
<body>
  @include('frontend.inc.header')
  <div class="clr"></div>
  @yield('content')
  @include('frontend.inc.footer')
  <!-- End Footer -->

  <a href="#" class="back-to-top">&#8593;</a>
  {{-- <a href="#" id="back-to-top" style="display: flex;justify-content: center;align-items: flex-end;"><i class="fas fa-arrow-up"></i></a> --}}
  <div id="preloader"></div>
  <!-- Vendor JS Files -->
  <script src="{{ asset('frontend/assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/venobox/venobox.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/aos/aos.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
  <script src="{{asset('backend/assets/js/jquery-toast-plugin/jquery.toast.min.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
  <script>
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
    }
  </script>
  <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  @yield('scripts')
</body>

</html>
