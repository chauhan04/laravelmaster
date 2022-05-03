@extends('frontend.layouts.master')

@section('content')


  <!-- ======= Login Section ======= -->
  <section id="contact" class="signin">
    <div class="container" data-aos="fade-up">

    <div class="row mt-1 d-flex justify-content-center" data-aos="fade-right" data-aos-delay="100">
      <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="100">
      @include('frontend.layouts.partials.message')
      </div>
    </div>

      <div class="section-title pb-0">
        <h2>{{ $pageTitle }}</h2>
      </div>

      <div class="row mt-1 d-flex justify-content-center" data-aos="fade-right" data-aos-delay="100">


        <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="100">

          <form action="{{ route('frontend.login.submit') }}" method="post" role="form" class="php-email-form">
            {{ csrf_field() }}
            <div class="form-group mt-3">
              <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="{{ __('Email') }}" required>
            </div>
            <div class="form-group mt-3">
              <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="{{ __('Password') }}" required>
            </div>
            <div class="form-group mt-3 text-end">
              @if (Route::has('frontend.forgotpassword'))
              <span class=""><a href="{{ route('frontend.forgotpassword') }}">{{ __('I forgot my password') }}</a></span>
              @endif
            </div>
            <div class="text-center mt-4"><button type="submit" class="submit-btn">Sign In</button></div>
            <div class="form-group mt-3 text-end">
              @if (Route::has('frontend.register'))
              <span class=""><a href="{{ route('frontend.register') }}">{{ __('Dont\'t have account, Sign Up') }}</a></span>
              @endif
            </div>
          </form>

        </div>

      </div>

    </div>
  </section><!-- End Login Section --> 

  
@endsection