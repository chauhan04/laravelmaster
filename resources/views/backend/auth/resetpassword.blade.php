@extends('backend.layouts.auth_master')

@section('content')

  <div class="card card-outline card-primary">

    <div class="card-body">
      <p class="login-box-msg">Reset your password</p>

      <form action="{{ route('admin.resetpassword') }}" method="post">
        {{ csrf_field() }}
        <div class="input-group mb-3">
          <input name="password" type="password" class="form-control" placeholder="New Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="confirm_password" type="password" class="form-control" placeholder="Confirm Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-6 ">
            &nbsp;
          </div>
          <div class="col-6 ">
            <input name="token" type="hidden" class="form-control" value="{{ $adminPasswordReset->token }}">
            <button type="submit" class="btn btn-primary btn-block">Change Password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      
    </div>
    <!-- /.card-body -->
  </div>
  
@endsection
