@extends('frontend.layouts.master')

@section('content')

  <!-- ======= Profile Section ======= -->
  <section id="edit-profile" class="edit-profile ">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>{{ $pageTitle }}</h2>
        </div>
        <div class=" ">
          @include('frontend.layouts.partials.message')
        </div>
        <form id="userEditForm" name="userEditForm" action="{{ route('frontend.register.submit') }}" method="post">
        {{ csrf_field() }}
        
        <div class=" ">
          <div class="form-group row">
            <label for="first_name" class="col-sm-2 col-lg-2 col-form-label">{{ __('First Name') }}:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="first_name" name="first_name" type="text" class="form-control " placeholder="{{ __('First Name') }}" value="{{ old('first_name') }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="last_name" class="col-sm-2 col-form-label">{{ __('Last Name') }}:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="last_name" name="last_name" type="text" class="form-control" placeholder="{{ __('Last Name') }}" value="{{ old('last_name') }}">
            </div>
          </div>
          <div class=" form-group row">
            <label for="username" class="col-sm-2 col-form-label">{{ __('Username') }}:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="username" name="username" type="text" class="form-control" placeholder="{{ __('Username') }}" value="{{ old('username') }}">
            </div>
          </div>
          <div class=" form-group row">
            <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="email" name="email" type="email" class="form-control" placeholder="{{ __('Email Address') }}" value="{{ old('email') }}">
            </div>
          </div>
        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">{{ __('Password') }}:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
                <input type="password" class="form-control" name="password" id="password" placeholder="{{ __('Password') }}" autocomplete="false">
            </div>
        </div>
        <div class="form-group row">
            <label for="confirm_password" class="col-sm-2 col-form-label">{{ __('Confirm Password') }}:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="{{ __('Confirm Password') }}" autocomplete="false">
            </div>
        </div>
          <div class=" form-group row">
            <label for="phone" class="col-sm-2 col-form-label">{{ __('Phone') }}:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="phone" name="phone" type="phone" class="form-control" placeholder="{{ __('Phone') }}" value="{{ old('phone') }}">
            </div>
          </div>
          <div class=" form-group row">
            <label for="address_line1" class="col-sm-2 col-form-label">{{ __('Address Line1') }}:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="address_line1" name="address_line1" type="text" class="form-control" placeholder="{{ __('Address Line1') }}" value="{{ old('address_line1') }}">
            </div>
          </div>
          <div class=" form-group row">
            <label for="address_line2" class="col-sm-2 col-form-label">{{ __('Address Line2') }}:</label>
            <div class="col-sm-10 col-lg-10">
              <input id="address_line2" name="address_line2" type="text" class="form-control" placeholder="{{ __('Address Line2') }}" value="{{ old('address_line2') }}">
            </div>
          </div>
          <div class=" form-group row">
            <label for="country" class="col-sm-2 col-form-label">{{ __('Country Code') }}:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="country" name="country" type="text" class="form-control" placeholder="{{ __('Country Code') }}" value="{{ old('country') }}">
            </div>
          </div>
          <div class=" form-group row">
            <label for="state" class="col-sm-2 col-form-label">{{ __('State') }}:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="state" name="state" type="text" class="form-control" placeholder="{{ __('State') }}" value="{{ old('state') }}">
            </div>
          </div>
          <div class=" form-group row">
            <label for="city" class="col-sm-2 col-form-label">{{ __('City') }}:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="city" name="city" type="text" class="form-control" placeholder="{{ __('City') }}" value="{{ old('city') }}">
            </div>
          </div>
          <div class=" form-group row">
            <label for="zipcode" class="col-sm-2 col-form-label">{{ __('Zip Code') }}:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="zipcode" name="zipcode" type="text" class="form-control" placeholder="{{ __('Zip Code') }}" value="{{ old('zipcode') }}">
            </div>
          </div>
        </div>

        <div class="mt-4 form-group row">
            <label for="zipcode" class="col-sm-2 col-form-label">&nbsp;</label>
            <div class="col-sm-10 col-lg-10">
                <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
            </div>
        </div>
        </form>
        
      </div>
    </section><!-- End Profile Section -->

@endsection