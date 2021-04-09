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
              <li class="breadcrumb-item active">categories</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <x-e-com_alert/>
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">categories</h3>
              <a href="/admin/add_edit_category" class="btn btn-success btn-sm float-right" 
                        type="submit"><i class="glyphicon glyphicon-plus"> add category
                     </i>  
                </a> 

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                <th>category</th>
                  <th>parent category</th>
                 <th>section</th>
                  <th>URL</th>
                  <th>status</th>
                  <th>actions</th>
                </tr>
                </thead>
                <tbody>
 @foreach($cates as $cate)                  
                <tr>
                  <td>{{$cate->id}}</td>
                         
                 {{--<td>{{!empty($cate->section) ? $cate->section->name:''}}</td>--}}
                 {{--if section colmun is empty then it show error so we use this code--}}   
                 <td>{{$cate->category_name}}</td> 
                 <td>{{!empty($cate->parent_cate) ? $cate->parent_cate->category_name:'null'}}</td>                
                  <td>{{$cate->section->name}}</td>
                  <td>{{$cate->url}}</td>
                  <td>
                    @if($cate->status==1)
                        <a class="updateCategoryStatus" id="category-{{$cate->id}}" category_id="{{$cate->id}}" href="javescript:void(0)">active</a>
                    @else
                       <a class="updateCategoryStatus" id="category-{{$cate->id}}" category_id="{{$cate->id}}" href="javescript:void(0)">inactive</a>
                    @endif     
                </td>
                <td>
                  <a href="/admin/add_edit_category/{{$cate->id}}">edit</a>
                  &nbsp;&nbsp;
                  <a href="javascript:void(0)" class="confirmDelete" name="Category" record="delete_category" recordid="{{$cate->id}}" {{--href="/admin/delete_category/{{$cate->id}}"-we have to use this link on sweet alert--}}>delete</a>
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
































