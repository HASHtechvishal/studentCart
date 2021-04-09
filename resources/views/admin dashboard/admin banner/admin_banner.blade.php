@extends('layouts.e-com admin layout.admin_layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper text-capitalize">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>catalogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">banners</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
     <x-e-com_alert/>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">banners</h3>
               <a href="/admin/add_edit_banner" class="btn btn-success btn-sm float-right" 
                        type="submit"><i class="fas fa-add"> add banners
                     </i>  
                </a> 
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="banners" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>image</th>
                  <th>link</th>
                  <th>title</th>
                  <th>alt</th>
                  <th>status</th>
                  <th>actions</th>
                </tr>
                </thead> 
                <tbody>
 @foreach($banners as $banner)                 
                <tr>
                  <td>{{$banner['id']}}</td>
                  <td>
                    <img style="width: 150px;" src="{{asset('e-com images/banner images/'.$banner['image'])}}" alt="image"></td>
                  <td>{{$banner['link']}}</td>
                  <td>{{$banner['title']}}</td>
                  <td>{{$banner['alt']}}</td>
                  
                  <td>
                    @if($banner['status']==1)
                        <a class="updatebannerstatus" id="banner-{{$banner['id']}}" banner_id="{{$banner['id']}}" href="javescript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                    @else
                       <a class="updatebannerstatus" id="banner-{{$banner['id']}}" banner_id="{{$banner['id']}}" href="javescript:void(0)"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                    @endif     
                </td>
                <td>
               <a title="edit banner" href="/admin/add_edit_banner/{{$banner['id']}}"><i class="fas fa-edit"></i></a>
                  &nbsp;&nbsp;
                  <a title="delete banner" href="javascript:void(0)" class="confirmDelete" name="banner" record="delete_banner" recordid="{{$banner['id']}}"><i class="fas fa-trash"></i></a>
                </td>
                </tr>
 @endforeach               
                </tbody>
                
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection




































