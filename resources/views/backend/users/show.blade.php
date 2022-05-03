@extends('backend.layouts.master')

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">

            <div class="card card-primary card-outline">

              <!-- /.card-header -->
              <div class="card-body">
                <div class=" ">
                  <div class="row">
                    <label for="first_name" class="col-sm-2 col-form-label">{{ __('First Name') }}: </label>
                    <div class="col-sm-10">
                    {{ $user->first_name }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="last_name" class="col-sm-2 col-form-label">{{ __('Last Name') }}: </label>
                    <div class="col-sm-10">
                    {{ $user->last_name }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="username" class="col-sm-2 col-form-label">{{ __('Username') }}: </label>
                    <div class="col-sm-10">
                    {{ $user->username }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}: </label>
                    <div class="col-sm-10">
                    {{ $user->email }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="phone" class="col-sm-2 col-form-label">{{ __('Phone') }}: </label>
                    <div class="col-sm-10">
                    {{ $user->phone }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="address_line1" class="col-sm-2 col-form-label">{{ __('Address Line1') }}: </label>
                    <div class="col-sm-10">
                    {{ $user->address_line1 }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="address_line2" class="col-sm-2 col-form-label">{{ __('Address Line2') }}: </label>
                    <div class="col-sm-10">
                    {{ $user->address_line2 }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="country" class="col-sm-2 col-form-label">{{ __('Country Code') }}: </label>
                    <div class="col-sm-10">
                    {{ $user->country }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="state" class="col-sm-2 col-form-label">{{ __('State') }}: </label>
                    <div class="col-sm-10">
                    {{ $user->state }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="city" class="col-sm-2 col-form-label">{{ __('City') }}: </label>
                    <div class="col-sm-10">
                    {{ $user->city }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="zipcode" class="col-sm-2 col-form-label">{{ __('Zip Code') }}: </label>
                    <div class="col-sm-10">
                    {{ $user->zipcode }}
                    </div>
                  </div>
                  
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info">{{ __('Edit User') }}</a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-default">{{ __('Back') }}</a>
                </div>
              </div>
            </div>

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">


        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

