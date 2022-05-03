@extends('frontend.layouts.master')

@section('content')

  <!-- ======= Profile Section ======= -->
  <section id="profile" class="profile ">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>{{ $pageTitle }}</h2>
        </div>
        <div class=" ">
          @include('frontend.layouts.partials.message')
        </div>
        <div class=" ">
          <div class=" row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('First Name') }}:</label>
            <div class="col-sm-10">
              {{ $user->first_name }}
            </div>
          </div>
          <div class=" row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('Last Name') }}:</label>
            <div class="col-sm-10">
              {{ $user->last_name }}
            </div>
          </div>
          <div class=" row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('Username') }}:</label>
            <div class="col-sm-10">
              {{ $user->username }}
            </div>
          </div>
          <div class=" row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('Email') }}:</label>
            <div class="col-sm-10">
              {{ $user->email }}
            </div>
          </div>
          <div class=" row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('Phone') }}:</label>
            <div class="col-sm-10">
              {{ $user->phone }}
            </div>
          </div>
          <div class=" row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('Address Line1') }}:</label>
            <div class="col-sm-10">
              {{ $user->address_line1 }}
            </div>
          </div>
          <div class=" row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('Address Line2') }}:</label>
            <div class="col-sm-10">
              {{ $user->address_line2 }}
            </div>
          </div>
          <div class=" row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('Country Code') }}:</label>
            <div class="col-sm-10">
              {{ $user->country }}
            </div>
          </div>
          <div class=" row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('State') }}:</label>
            <div class="col-sm-10">
              {{ $user->state }}
            </div>
          </div>
          <div class=" row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('City') }}:</label>
            <div class="col-sm-10">
              {{ $user->city }}
            </div>
          </div>
          <div class=" row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('Zip') }}:</label>
            <div class="col-sm-10">
              {{ $user->zipcode }}
            </div>
          </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('frontend.profile.edit') }}" class="btn btn-info">{{ __('Edit Profile') }}</a>
        </div>
        
      </div>
    </section><!-- End Profile Section -->

@endsection