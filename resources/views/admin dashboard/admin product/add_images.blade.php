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
              <li class="breadcrumb-item active">products images</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 
    <section class="content">
      <div class="container-fluid">
        <x-e-com_alert/>
 {{--we need 2 action one for edit and other for add--}}       
      	<form @if(empty($product_image['id']))action="{{url('/admin/add_image')}}" @else action="{{url('/admin/add_image/'.$product_image['id'])}}"  @endif  method="post" name="add_image" id="pro_form" enctype="multipart/form-data">@csrf
      		{{--as id will not come for add product--}}
   {{--<input type="hidden" name="product_id" id="" value="{{$product_image['id']}}">--}}    
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{$title_image}}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6"> 
              </div>

              <div class="col-md-6"> 

              	 <div class="form-group">
               	<label for="product_name">product name:</label>&nbsp;
                <span> {{$product_image['product_name']}}</span>
              
               </div>
             </div>
                
                  <div class="col-md-6"> 
                 <div class="form-group">
                <label for="code_name">product code:</label>
                &nbsp;
                <span> {{$product_image['product_code']}}</span>
                
               </div>
             </div>
            
              <div class="col-md-6"> 
                <div class="form-group">
                <label for="color_name">product color: </label>
                &nbsp;
                <span> {{$product_image['product_color']}}</span>

               </div>
             </div>
      
              <div class="col-md-6"> 
             <div class="form-group">
          <div>            
 <img style="width: 120px;"  src="{{asset('e-com images/product images/small_img/'.$product_image['main_image'])}}" alt="image">             
               </div>
             </div>
            </div>

              <div class="col-md-6"> 
             <div class="form-group">
         <div class="field_wrapper">
    <div>
        <input multiple="" id="image" name="image[]" type="file" name="image[]" required="" />
    </div>
</div>
 </div>
            </div>
          </div>
          <div class="card-footer ">
            <button type="submit" class="btn btn-primary float-right">Add Images</button>
          </div>
        </div>
    </form>

<form action="{{url('admin/edit_attr/'.$product_image['id'])}}" method="post" name="edit_attr" id="edit_attr">@csrf
     <div class="card">
            <div class="card-header">
              <h3 class="card-title">added product images</h3>
              

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="products" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                <th>image</th>
                <th>actions</th>
                </tr>
                </thead>
                <tbody>
 @foreach($product_image['images'] as $images)              
  <input style="display: none;" type="text" name="attr_id[]" value="{{$images['id']}}">           
                <tr>
                  <td>{{$images['id']}}</td>   
                 <td><img style="width: 120px;"  src="{{asset('e-com images/product images/small_img/'.$images['image'])}}" alt="image"></td>
                 <td> 
                    @if($images['status']==1)
                        <a class="updateimagestatus" id="image-{{$images['id']}}" images_id="{{$images['id']}}" href="javescript:void(0)">active</a>
                    @else
                       <a class="updateimagestatus" id="image-{{$images['id']}}" images_id="{{$images['id']}}" href="javescript:void(0)">inactive</a>
                    @endif
                                      &nbsp;&nbsp;
     <a title="delete images" href="javascript:void(0)" class="confirmDelete" name="Category" record="delete_image" recordid="{{$images['id']}}" ><i class="fas fa-trash"></i></a> 
                  </td>
               </tr>
               
 @endforeach                
                </tbody>
                <tfoot>
              
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->

             <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right">Update images</button>
          </div>
          </div>

      </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection 





























