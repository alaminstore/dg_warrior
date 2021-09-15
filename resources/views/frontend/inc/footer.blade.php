<footer id="footer">
    <style>
        .flex_subs {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        align-items: center;
    }
    </style>
    @if (url()->current() == url('/'))
    {{-- <div class="footer-top">
        <div class="container">
          <div class="flex_subs">
            <div class="col-lg-4 col-md-6 footer-newsletter">
              <h4>Subscribe News Letter</h4>
              <p>Subscribe to our news letter to receive latest promotions, rewards and news from DG  Warrior</p>
              <form action="" method="post">
                <input type="email" name="email"><input type="submit" value="Subscribe">
              </form>
            </div>

          </div>
        </div>
      </div> --}}
    @endif

    <div class="container d-md-flex py-4">
      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          Copyright &copy; 2021 <span style="color: #9b92ff;">DG Warrior</span>. All rights reserved.
        </div>
        <div class="credits"></div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
        <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
        <a href="#" class="google-plus"><i class="fa fa-skype"></i></a>
        <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
      </div>
    </div>
  </footer>
