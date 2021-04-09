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
              <li class="breadcrumb-item active">brands</li>
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
              <h3 class="card-title">{{$title_brand}}</h3>
               <a href="/admin/add_edit_brand" class="btn btn-success btn-sm float-right" 
                        type="submit"><i class="fas fa-add"> add brands
                     </i>  
                </a> 
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="brands" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>name</th>
                  <th>status</th>
                  <th>actions</th>
                </tr>
                </thead>
                <tbody>
 @foreach($brands as $brand)                 
                <tr>
                  <td>{{$brand->id}}</td>
                  <td>{{$brand->name}}
                  </td>
                  <td>
                    @if($brand->status==1)
                        <a class="updatebrandtatus" id="brand-{{$brand->id}}" brand_id="{{$brand->id}}" href="javescript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                    @else
                       <a class="updatebrandtatus" id="brand-{{$brand->id}}" brand_id="{{$brand->id}}" href="javescript:void(0)"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                    @endif     
                </td>
                <td>
               <a title="edit brand" href="/admin/add_edit_brand/{{$brand->id}}"><i class="fas fa-edit"></i></a>
                  &nbsp;&nbsp;
                  <a title="delete brand" href="javascript:void(0)" class="confirmDelete" name="brand" record="delete_brand" recordid="{{$brand->id}}"><i class="fas fa-trash"></i></a>
                </td>
                </tr>
 @endforeach               
                </tbody>
                <tfoot>
              
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection




































