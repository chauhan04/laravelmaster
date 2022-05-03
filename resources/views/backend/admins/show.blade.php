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
                    <label for="admin_name" class="col-sm-2 col-form-label">{{ __('First Name') }}: </label>
                    <div class="col-sm-10">
                    {{ $admin->first_name }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="admin_name" class="col-sm-2 col-form-label">{{ __('Last Name') }}: </label>
                    <div class="col-sm-10">
                    {{ $admin->last_name }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="admin_name" class="col-sm-2 col-form-label">{{ __('Username') }}: </label>
                    <div class="col-sm-10">
                    {{ $admin->username }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="admin_name" class="col-sm-2 col-form-label">{{ __('Email') }}: </label>
                    <div class="col-sm-10">
                    {{ $admin->email }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="admin_name" class="col-sm-2 col-form-label">{{ __('Phone') }}: </label>
                    <div class="col-sm-10">
                    {{ $admin->phone }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="admin_name" class="col-sm-2 col-form-label">{{ __('Address Line1') }}: </label>
                    <div class="col-sm-10">
                    {{ $admin->address_line1 }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="admin_name" class="col-sm-2 col-form-label">{{ __('Address Line2') }}: </label>
                    <div class="col-sm-10">
                    {{ $admin->address_line2 }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="admin_name" class="col-sm-2 col-form-label">{{ __('Country Code') }}: </label>
                    <div class="col-sm-10">
                    {{ $admin->country }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="admin_name" class="col-sm-2 col-form-label">{{ __('State') }}: </label>
                    <div class="col-sm-10">
                    {{ $admin->state }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="admin_name" class="col-sm-2 col-form-label">{{ __('City') }}: </label>
                    <div class="col-sm-10">
                    {{ $admin->city }}
                    </div>
                  </div>
                  <div class="row">
                    <label for="admin_name" class="col-sm-2 col-form-label">{{ __('Zip Code') }}: </label>
                    <div class="col-sm-10">
                    {{ $admin->zipcode }}
                    </div>
                  </div>
                  
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-info">{{ __('Edit Admin') }}</a>
                    <a href="{{ route('admin.admins.index') }}" class="btn btn-default">{{ __('Back') }}</a>
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

