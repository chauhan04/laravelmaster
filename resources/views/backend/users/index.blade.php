@extends('backend.layouts.master')

@push('head')
  @include('backend.layouts.partials.datatable-css')
@endpush

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">&nbsp;</h3>
                <div class="text-right">
                <a class="btn btn-primary" href="{{ route('admin.users.create') }}">{{ __('Add New User') }}</a>
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="userlist" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('First Name') }}</th>
                    <th>{{ __('Last Name') }}</th>
                    <th>{{ __('Username') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Phone') }}</th>
                    <th>{{ __('Actions') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                      <form action="{{ route('admin.users.destroy',$user->id) }}" method="POST">   
                        <a class="btn btn-info" href="{{ route('admin.users.show',$user->id) }}">{{ __('Show') }}</a>    
                        <a class="btn btn-primary" href="{{ route('admin.users.edit',$user->id) }}">{{ __('Edit') }}</a>   
                        @csrf
                        @method('DELETE')      
                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('First Name') }}</th>
                    <th>{{ __('Last Name') }}</th>
                    <th>{{ __('Username') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Phone') }}</th>
                    <th>{{ __('Actions') }}</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
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
  @include('backend.layouts.partials.datatable-js')
  <script>
    $(function () {
      $("#userlist").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false
        //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          
    });
  </script>
@endsection