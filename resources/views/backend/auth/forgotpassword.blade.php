@extends('backend.layouts.auth_master')

@section('content')

  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-body login-card-body">
      <p class="login-box-msg">{{ __('Enter email to reset your password') }}</p>

      <form action="{{ route('admin.forgotpassword.link') }}" method="post">
        {{ csrf_field() }}
        <div class="input-group mb-3">
          <input id="email" name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        </div>
        
        <div class="row">
          <div class="col-8">

          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Submit') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      @if (Route::has('admin.login'))
      <p class="mb-1">
        <a href="{{ route('admin.login') }}">{{ __('Sign In') }}</a>
      </p>
       @endif
    </div>
    <!-- /.login-card-body -->
  </div>



@endsection
