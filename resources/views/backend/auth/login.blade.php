@extends('backend.layouts.auth_master')

@section('content')

  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{ route('admin.login.submit') }}" method="post">
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
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
                {{ __('Remember Me') }}
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Sign In') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      @if (Route::has('admin.forgotpassword'))
      <p class="mb-1">
        <a href="{{ route('admin.forgotpassword') }}">{{ __('I forgot my password') }}</a>
      </p>
       @endif
    </div>
    <!-- /.login-card-body -->
  </div>

@endsection