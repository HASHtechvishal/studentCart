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
                <h3 class="card-title">change admin data</h3>
              </div>
              <br>
              <x-e-com_alert/>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{url('/admin/update_admin_data')}}" name="admin_data_form" id="admin_up" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">admin Email</label>
                    <input class="form-control" value="{{Auth::guard('admin')->user()->email}}" readonly="">
{{--we can use value="{{Auth::guard('admin')->user()->email}}"--}}                  
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">admin type</label>
                    <input class="form-control" value="{{Auth::guard('admin')->user()->type}}" readonly="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">admin name</label>
                    <input type="text" value="{{Auth::guard('admin')->user()->name}}" class="form-control" id="name_id" name="name_name" placeholder="enter your name" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">admin contact</label>
                    <input type="tel" value="{{Auth::guard('admin')->user()->contact}}" class="form-control" id="num_id" name="num_name" placeholder="enter your contact" required="">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputPassword1">admin image</label>
                    <input type="file" class="form-control" id="img_id" name="img_name" accept="image/*">
                    @if(!empty(Auth::guard('admin')->user()->image))
                    <a target="_blank" href="{{url('e-com images/admin images/admin_pic/'.Auth::guard('admin')->user()->image)}}">view image</a>
                    <input type="hidden" name="admin_image" value="{{Auth::guard('admin')->user()->image}}">
                    @endif
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
 




































