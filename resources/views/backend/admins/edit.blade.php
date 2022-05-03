@extends('backend.layouts.master')

@push('head')
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
@endpush

@section('content')


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">

            <!-- general form elements -->
            <div class="card card-primary card-outline">

              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" id="adminForm" action="{{ route('admin.admins.update', $admin->id) }}">
                @csrf
                {{ method_field('PATCH') }}
                <div class="card-body">

                  <div class="form-group">
                    <label for="first_name">{{ __('First Name') }}:<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="{{ __('First Name') }}" value="{{ old('first_name',$admin->first_name) }}">
                  </div>
                  <div class="form-group">
                    <label for="last_name">{{ __('Username') }}:<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="{{ __('Last Name') }}" value="{{ old('last_name',$admin->last_name) }}">
                  </div>
                  <div class="form-group">
                    <label for="username">{{ __('Username') }}:<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="{{ __('Username') }}" value="{{ old('username',$admin->username) }}">
                  </div>
                  <div class="form-group">
                    <label for="email">{{ __('Enter email') }}:<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="{{ __('Enter email') }}" value="{{ old('email',$admin->email) }}">
                  </div>
                  <div class="form-group">
                    <label for="password">{{ __('Password') }}:</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="{{ __('Password') }}" autocomplete="false">
                  </div>
                  <div class="form-group">
                    <label for="confirm_password">{{ __('Confirm Password') }}:</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="{{ __('Confirm Password') }}" autocomplete="false">
                  </div>
                  <div class="form-group">
                      <label for="phone">{{ __('Username') }}:<span class="text-danger">*</span></label>
                      <input type="phone" class="form-control" name="phone" id="phone" placeholder="{{ __('Phone') }}" autocomplete="false" value="{{ old('phone',$admin->phone) }}">
                  </div>
                  <div class=" form-group">
                      <label for="address_line1" class="col-sm-2 col-form-label">{{ __('Address Line1') }}:<span class="text-danger">*</span></label>
                      <input id="address_line1" name="address_line1" type="text" class="form-control" placeholder="{{ __('Address Line1') }}" value="{{ old('address_line1',$admin->address_line1) }}">
                  </div>
                  <div class=" form-group">
                      <label for="address_line2" class="col-sm-2 col-form-label">{{ __('Address Line2') }}:</label>
                      <input id="address_line2" name="address_line2" type="text" class="form-control" placeholder="{{ __('Address Line2') }}" value="{{ old('address_line2',$admin->address_line2) }}">
                  </div>
                  <div class=" form-group">
                      <label for="country" class="col-sm-2 col-form-label">{{ __('Country Code') }}:<span class="text-danger">*</span></label>
                      <input id="country" name="country" type="text" class="form-control" placeholder="{{ __('Country Code') }}" value="{{ old('country',$admin->country) }}">
                  </div>
                  <div class=" form-group">
                      <label for="state" class="col-sm-2 col-form-label">{{ __('State') }}:<span class="text-danger">*</span></label>
                      <input id="state" name="state" type="text" class="form-control" placeholder="{{ __('State') }}" value="{{ old('state',$admin->state) }}">
                  </div>
                  <div class=" form-group">
                      <label for="city" class="col-sm-2 col-form-label">{{ __('City') }}:<span class="text-danger">*</span></label>
                      <input id="city" name="city" type="text" class="form-control" placeholder="{{ __('City') }}" value="{{ old('city',$admin->city) }}">
                  </div>
                  <div class=" form-group">
                      <label for="zip" class="col-sm-2 col-form-label">{{ __('Zip Code') }}:<span class="text-danger">*</span></label>
                      <input id="zipcode" name="zipcode" type="text" class="form-control" placeholder="{{ __('Zip Code') }}" value="{{ old('zipcode',$admin->zipcode) }}">
                  </div>
                  <div class=" form-group">
                      <label for="status" class="col-sm-2 col-form-label">{{ __('Status') }}:<span class="text-danger">*</span></label>
                      <select id="status" name="status" class="custom-select rounded-0" id="exampleSelectRounded0">
                          <option value="1"  {{(old('status',$admin->status) === 1) ? 'selected="selected"':''}} >{{ __('Active') }}</option>
                          <option value="0" {{(old('status',$admin->status) === 0) ? 'selected="selected"':''}} >{{ __('Inactive') }}</option>
                      </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{ __('Save Admin') }}</button>
                  <a href="{{ route('admin.admins.index') }}" class="btn btn-default">{{ __('Back') }}</a>
                </div>
              </form>
            </div>
            <!-- /.card -->

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

@section('footer-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $("#adminForm").validate({
            rules: {
                first_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                username: {
                    required: true,
                    minlength: 5
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 50
                },
                phone: {
                    required: true,
                },
                address_line1: {
                    required: true,
                },
                country: {
                    required: true,
                },
                state: {
                    required: true,
                },
                city: {
                    required: true,
                },
                zipcode: {
                    required: true,
                }      
            },
            messages: {
                first_name: {
                    required: "Please enter first name"
                },
                last_name: {
                    required: "Please enter last name"
                },
                username: {
                    required: "Please provide username",
                    minlength: "Your username must be at least 5 characters long"
                },
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a valid email address",
                    maxlength: "Email cannot be more than 50 characters",
                },
                phone: {
                    required: "Please enter phone"
                },
                address_line1: {
                    required: "Please enter Address Line1"
                },
                country: {
                    required: "Please enter country code"
                },
                state: {
                    required: "Please enter state"
                },
                city: {
                    required: "Please enter city"
                },
                zipcode: {
                    required: "Please enter zip"
                }
            }
        });
    });
</script>
@endsection