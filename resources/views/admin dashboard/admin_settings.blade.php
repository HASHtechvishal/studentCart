@extends('layouts.e-com admin layout.admin_layout')
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper text-capitalize">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">admin settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
      <!-- Main content -->
    <section class="content text-capitalize">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">change password</h3>
              </div>
              <br>
              <x-e-com_alert/>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{url('/admin/update')}}" name="up_form" id="form_up">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">admin Email</label>
                    <input class="form-control" value="{{$admin_data->email}}" readonly="">
{{--we can use value="{{Auth::guard('admin')->user()->email}}"--}}                  
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">current Password</label>
                    <input type="password" class="form-control" id="current_id" name="current_name" placeholder="current Password" required="">
                    <span id="check_pwd"></span>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputPassword1">new Password</label>
                    <input type="password" class="form-control" id="new_id" name="new_name" placeholder="new Password" required="">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputPassword1">confirm Password</label>
                    <input type="password" class="form-control" id="confirm_id" name="confirm_name" placeholder="confirm Password" required="">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection