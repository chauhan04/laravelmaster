@extends('frontend.layouts.master')

@section('content')


    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2><?=$pageTitle?></h2>
          <p>Meet with our excellent team.</p>
        </div>

        <div class="row">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="{{ asset('frontend/images/team/team-1.jpg') }}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Lorem Ipsum</h4>
                <span>Wed Developer</span>
                <p>There are many variations of passages of Lorem Ipsum available</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="{{ asset('frontend/images/team/team-2.jpg') }}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Lorem Ipsum</h4>
                <span>Wed Designer</span>
                <p>If you are going to use a passage of Lorem Ipsum.</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>


        </div>

      </div>
    </section><!-- End Team Section --> 
    
@endsection