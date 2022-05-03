@extends('frontend.layouts.master')

@section('content')

<!-- ======= Reset Password Section ======= -->
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

            <form action="{{ route('frontend.resetpassword') }}" method="post" role="form" class="php-email-form">
            {{ csrf_field() }}
              <div class="form-group mt-3">
                <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="{{ __('password') }}" required autofocus>
              </div>
              <div class="form-group mt-3">
                <input type="password" class="form-control {{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" name="confirm_password" id="confirm_password" placeholder="{{ __('Confirm Password') }}" required>
              </div>

              <div class="text-center mt-4">
              <input name="token" type="hidden" class="form-control" value="{{ $userPasswordReset->token }}">
                <button type="submit" class="submit-btn">{{ __('Change Password') }}</button>
              </div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Reset Password Section --> 
  
@endsection
