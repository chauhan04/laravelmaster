@extends('frontend.layouts.master')

@section('content')

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
      <div class="container" data-aos="fade-up">
        @include('frontend.layouts.partials.message')
        <div class="section-title">
          <h2><?=$pageTitle?></h2>
        </div>

        <div class="row mt-1 d-flex justify-content-end" data-aos="fade-right" data-aos-delay="100">

          <div class="col-lg-5">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>{{ __('Location') }}:</h4>
                <p>Address line</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>{{ __('Email') }}:</h4>
                <p>developer8here@gmail.com</p>
              </div>

            </div>

          </div>

          <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="100">

            <form action="{{ route('frontend.contact.send') }}" method="post" role="form" class="php-email-form">
            {{ csrf_field() }}
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" class="form-control" name="name" id="name" placeholder="{{ __('Your Name') }}" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="{{ __('Your Email') }}" value="{{ old('email') }}" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="{{ __('Subject') }}" value="{{ old('subject') }}" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="{{ __('Message') }}" required>{{ old('message') }}</textarea>
              </div>
              <div class="my-3">
                <div class="loading">{{ __('Loading') }}</div>
                <div class="error-message"></div>
                <div class="sent-message">{{ __('Your message has been sent. Thank you!') }}</div>
              </div>
              <div class="text-center"><button type="submit">{{ __('Send Message') }}</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section --> 

    
@endsection