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
              <li class="breadcrumb-item active">products</li>
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
              <h3 class="card-title">products</h3>
              <a href="/admin/add_edit_product" class="btn btn-success btn-sm float-right" 
                        type="submit"><i class="glyphicon glyphicon-plus"> add product
                     </i>  
                </a> 

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="products" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                <th>product name</th>
                  <th>product code</th>
                 <th>product color</th>
                 <th>product image</th>
                 <th>category</th>
                 <th>section</th>
                  <th>status</th>
                  <th>actions</th>
                </tr>
                </thead>
                <tbody>
 @foreach($products as $product)                 
                <tr>
                  <td>{{$product->id}}</td>   
                 <td>{{$product->product_name}}</td> 
                 <td>{{$product->product_code}}</td>
                  <td>{{$product->product_color}}</td>
 {{--in case if it show error because of category column is empty so use cade if !empty--}} 

                   <td>
 <?php $product_image_path = "e-com images/product images/small_img/".$product->main_image; ?>                   
                    @if(!empty($product->main_image) && file_exists($product_image_path))
                  <img style="width: 80px" src="{{asset('e-com images/product images/small_img/'.$product->main_image)}}" alt="image">
                  @else
                  <img style="width: 80px" src="{{asset('e-com images/product images/small_img/no_image.png')}}" alt="image">
                  @endif
                  </td>


                  <td>{{$product->category->category_name}}</td>
                  <td>{{$product->section->name}}</td> 
                  <td>
                   @if($product->status==1)
                        <a class="updateProductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}" href="javescript:void(0)">active</a>
                    @else
                       <a class="updateProductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}" href="javescript:void(0)">inactive</a>
                    @endif   
                </td> 
                <td style="width: 120px;">

                <a title="add attributes" href="/admin/add_attri/{{$product->id}}"><i class="fas fa-plus"></i></a>
                
                &nbsp;&nbsp;
                <a title="add images" href="/admin/add_image/{{$product->id}}"><i class="fas fa-plus-circle"></i></a>
                &nbsp;&nbsp;


               <a title="edit product" href="/admin/add_edit_product/{{$product->id}}"><i class="fas fa-edit"></i></a>

               
                  &nbsp;&nbsp;
                  <a title="delete product" href="javascript:void(0)" class="confirmDelete" name="Category" record="delete_product" recordid="{{$product->id}}" {{--href="/admin/delete_product/{{$cate->id}}"-we have to use this link on sweet alert--}}><i class="fas fa-trash"></i></a>
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
































