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
              <li class="breadcrumb-item active">products attributes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  

    <section class="content">
      <div class="container-fluid"> 
        <x-e-com_alert/>
 {{--we need 2 action one for edit and other for add--}}       
      	<form @if(empty($product_data['id']))action="{{url('/admin/add_attri')}}" @else action="{{url('/admin/add_attri/'.$product_data['id'])}}"  @endif  method="post" name="add_attri" id="pro_form" enctype="multipart/form-data">@csrf
      		{{--as id will not come for add product--}}
   {{--<input type="hidden" name="product_id" id="" value="{{$product_data['id']}}">--}}    
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{$title_attr}}</h3>

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
                <span> {{$product_data['product_name']}}</span>
              
               </div>
             </div>
                
                  <div class="col-md-6"> 
                 <div class="form-group">
                <label for="code_name">product code:</label>
                &nbsp;
                <span> {{$product_data['product_code']}}</span>
                
               </div>
             </div>
            
              <div class="col-md-6"> 
                <div class="form-group">
                <label for="color_name">product color: </label>
                &nbsp;
                <span> {{$product_data['product_color']}}</span>

               </div>
             </div>
      
              <div class="col-md-6"> 
             <div class="form-group">
          <div>            
 <img style="width: 120px;"  src="{{asset('e-com images/product images/small_img/'.$product_data['main_image'])}}" alt="image">             
               </div>
             </div>
            </div>

              <div class="col-md-6"> 
             <div class="form-group"> 
               
         <div class="field_wrapper">   
    <div>
        <input id="size" name="size[]" type="text" name="size[]" value="" placeholder="Size" style="width:120px;" required="" />
        <input id="sku" name="sku[]" type="text" name="sku[]" value="" placeholder="SKU" style="width:120px;" required="" />
        <input id="price" name="price[]" type="numver" name="price[]" value="" placeholder="Price" style="width:120px;" required="" />
        <input id="stock" name="stock[]" type="number" name="stock[]" value="" placeholder="Stock" style="width:120px;" required="" />
        <a href="javascript:void(0);" class="add_button" title="Add field">add</a>
    </div>
</div>
 
 </div>
            </div>


          </div>
          <div class="card-footer ">
            <button type="submit" class="btn btn-primary float-right">Add Attributes</button>
          </div>
        </div>
    </form>

<form action="{{url('admin/edit_attr/'.$product_data['id'])}}" method="post" name="edit_attr" id="edit_attr">@csrf
     <div class="card">
            <div class="card-header">
              <h3 class="card-title">added product attributes</h3>
              

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="products" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                <th>size</th>
                  <th>SKU</th>
                 <th>price</th>
                 <th>stock</th>
                <th>actions</th>
                </tr>
                </thead>
                <tbody>
 @foreach($product_data['attribute'] as $attribute)              
  <input style="display: none;" type="text" name="attr_id[]" value="{{$attribute['id']}}">           
                <tr>
                  <td>{{$attribute['id']}}</td>   
                 <td>{{$attribute['size']}}</td> 
                 <td>{{$attribute['sku']}}</td>
                  <td><input type="number" name="price[]" value="{{$attribute['price']}}" required="" style="width: 80px;"></td>
                  <td><input type="number" name="stock[]" value="{{$attribute['stock']}}" required="" style="width: 80px;"></td>
 {{--in case if it show error because of category column is empty so use cade if !empty--}}  
                   <td>
                    @if($attribute['status']==1)
                        <a class="updateAttributeStatus" id="attribute-{{$attribute['id']}}" attribute_id="{{$attribute['id']}}" href="javescript:void(0)">active</a>
                    @else
                       <a class="updateAttributeStatus" id="attribute-{{$attribute['id']}}" attribute_id="{{$attribute['id']}}" href="javescript:void(0)">inactive</a>
                    @endif
                                      &nbsp;&nbsp;
     <a title="delete attribute" href="javascript:void(0)" class="confirmDelete" name="Category" record="delete_attribute" recordid="{{$attribute['id']}}" ><i class="fas fa-trash"></i></a> 
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
            <button type="submit" class="btn btn-primary float-right">Update Attributes</button>
          </div>
          </div>

      </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection





























