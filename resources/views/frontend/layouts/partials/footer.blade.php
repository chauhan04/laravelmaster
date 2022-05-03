<!-- ======= Footer ======= -->
<footer id="footer">

@if(Route::is('frontend.index'))  
  <div class="footer-newsletter">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h4>Newsletter</h4>
        <p>Subscribe to get updated with our posting</p>
      </div>
      <div class="col-lg-6">
        <form action="{{ route('frontend.subscribe') }}" method="post">
          {{ csrf_field() }}
          <input type="email" name="email"><input type="submit" value="Subscribe">
        </form>
      </div>
    </div>
  </div>
</div>
@endif

<div class="footer-top">
  <div class="container">
    <div class="row">

      <div class="col-lg-3 col-md-6 footer-links">
        <h4>Useful Links</h4>
        <ul>
          <li><i class="bx bx-chevron-right"></i> <a href="{{ route('frontend.index') }}">Home</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="{{ route('frontend.aboutus') }}">About us</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="{{ route('frontend.contactus') }}">Contact us</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 footer-links">
        <h4>Our Services</h4>
        <ul>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 footer-contact">
        <h4>Contact Us</h4>
        <p>
          Contact Address <br>
          Goes, here<br><br>
          <strong>Email:</strong> developer8here@gmail.com<br>
        </p>

      </div>

      <div class="col-lg-3 col-md-6 footer-info">
        <h3>About Laravel</h3>
        <p>Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things.</p>
        <div class="social-links mt-3">
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="container">
  <div class="copyright">
    &copy; Copyright <strong><span>Anyar</span></strong>. All Rights Reserved
  </div>
  <div class="credits">
    <!-- All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/anyar-free-multipurpose-one-page-bootstrap-theme/ -->
    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
  </div>
</div>
</footer><!-- End Footer -->
