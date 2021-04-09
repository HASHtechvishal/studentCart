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

    <section class="content">
      <div class="container-fluid">
        <x-e-com_alert/>
 {{--we need 2 action one for edit and other for add--}}       
      	<form @if(empty($product_data['id']))action="{{url('/admin/add_edit_product')}}" @else action="{{url('/admin/add_edit_product/'.$product_data['id'])}}"  @endif  method="post" name="pro_form" id="pro_form" enctype="multipart/form-data">@csrf
      		{{--as id will not come for add product--}}
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{$title_product}}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6"> 
                 <div class="form-group">
                  <label>select category </label> 
                  <select name="category_name" id="category_id" class="form-control select2" style="width: 100%;">
                    <option value="">select</option>
 @foreach($categories as $section)
 <optgroup label="{{$section['name']}}"></optgroup>{{--optgroup which dont selected--}}
 @foreach($section['categories'] as $category) 
 <option value="{{$category['id']}}" @if(!empty(@old('category_name')) && $category['id']==@old('category_name')) @elseif(!empty($product_data['category_id']) && $product_data['category_id']==$category['id']) selected="" @endif>&nbsp;&nbsp;&nbsp;{{$category['category_name']}}</option>


 
 @foreach($category['sub_categories'] as $subcategory)
 <option value="{{$subcategory['id']}}" @if(!empty(@old('category_name')) && $subcategory['id']== @old('category_name')) @elseif(!empty($product_data['category_id']) && $product_data['category_id']==$subcategory['id']) selected="" @endif>&nbsp;&nbsp;&nbsp;>>&nbsp;&nbsp;{{$subcategory['category_name']}}</option>
 @endforeach
 @endforeach
 @endforeach                   
                    </select>
                </div>

                <div class="form-group">
                  <label>select brands</label>
                  <select name="brand" id="brand" class="form-control select2" style="width: 100%;">
                    <option value="">select</option>
 @foreach($brands as $brand)
<option value="{{$brand['id']}}"  @if(!empty($product_data['brand_id']) && $product_data['brand_id']==$brand['id']) selected="" @endif>{{$brand['name']}}</option> 
@endforeach 
              </select>
                </div>

              </div>

              <div class="col-md-6"> 

              	 <div class="form-group">
               	<label for="product_name">product name</label>
               	<input type="text" name="pro_name" id="pro_id" class="form-control" placeholder="enter product name" 
                @if(!empty($product_data['product_name'])) value="{{$product_data['product_name']}}" @else value="{{@old('product_name')}}" @endif>
 {{--old function use for old validation for add data--}}               
               </div>
             </div>
                
                  <div class="col-md-6"> 
                 <div class="form-group">
                <label for="code_name">product code</label>
                <input type="text" name="code_name" id="code_id" class="form-control" placeholder="enter product code" @if(!empty($product_data['product_code'])) value="{{$product_data['product_code']}}" @else value="{{old('product_code')}}" @endif>
               </div>
             </div>
            
              <div class="col-md-6"> 
                <div class="form-group">
                <label for="color_name">product color</label>
                <input type="text" name="color_name" id="color_id" class="form-control" placeholder="enter product color" @if(!empty($product_data['product_color'])) value="{{$product_data['product_color']}}" @else value="{{old('product_color')}}" @endif>
               </div>
             </div>


              <div class="col-md-6"> 
                <div class="form-group">
                <label for="price_name">product price</label>
                <input type="text" name="price_name" id="price_id" class="form-control" placeholder="enter product price" @if(!empty($product_data['product_price'])) value="{{$product_data['product_price']}}" @else value="{{old('product_price')}}" @endif>
               </div>
             </div>

              <div class="col-md-6"> 
                <div class="form-group">
                <label for="weight_name">product weight</label>
                <input type="text" name="weight_name" id="weight_id" class="form-control" placeholder="enter product weight" @if(!empty($product_data['product_weight'])) value="{{$product_data['product_weight']}}" @else value="{{old('product_weight')}}" @endif>
               </div>
             </div>

              <div class="col-md-6"> 
             <div class="form-group">
               	<label for="pro_img">product main image</label>
               	<div class="input-group">
               		<div class="custom-file">
               			<input type="file" class="custom-file-input" id="pro_img" name="pro_img"  @if(!empty($product_data['pro_img'])) value="{{$product_data['pro_img']}}" @else value="{{old('pro_img')}}" @endif>
               			<label for="pro_img" class="custom-file-label">choose file</label>
               		</div>
               		<div class="input-group-append">
               			<span class="input-group-text" id="">upload</span>
               		</div>
                </div> 
                <div style="color: green">recommended image size: width:1040px, height:1200px</div>
@if(!empty($product_data['main_image']))
 <div>
 <img style="width: 80px; margin-top:5px;" src="{{asset('e-com images/product images/small_img/'.$product_data['main_image'])}}" alt="image">&nbsp;

 <a href="javascript:void(0)" class="confirmDelete" record="delete_product_image" recordid="{{$product_data['id']}}">delete image</a> 
 
</div>
@endif                 
               </div>
             </div>

              <div class="col-md-6"> 
                   <div class="form-group">
                <label for="product_video">product video</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="product_video" name="product_video"  @if(!empty($product_data['weight_name'])) value="{{$product_data['product_video']}}" @else value="{{old('product_video')}}" @endif>
                    <label for="product_video" class="custom-file-label">choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text" id="">upload</span>
                  </div>
                </div>
@if(!empty($product_data['product_video']))
<div>
  <a href="javascript:void(0)" class="confirmDelete" record="delete_product_video" recordid="{{$product_data['id']}}">delete video</a>
  <a class="float-right" href="{{url('e-com video/product_videos/'.$product_data['product_video'])}}" download="" target="_blank">download</a>
</div> 
@endif   
               </div>
             </div>

             
              <div class="col-md-6"> 
               <div class="form-group">
                <label for="pro_dis">product discount (%)</label>
                <input type="text" name="pro_dis" id="pro_dis" class="form-control" placeholder="enter product"
                @if(!empty($product_data['product_discount'])) value="{{$product_data['product_discount']}}" @else value="{{old('product_discount')}}" @endif>
               </div>
             </div>

                       
            <div class="row">
              <div class="col-12 col-sm-6">
          
               	<div class="form-group">
               	<label for="pro_des">product description</label>
               	<textarea name="pro_des" id="pro_des" rows="3" class="form-control" placeholder="Enter ...">@if(!empty($product_data['description'])){{$product_data['description']}}@else{{old('description')}}@endif</textarea>
               </div>
              </div>
              <div class="col-12 col-sm-6">
                  <div class="form-group">
                <label for="wash_care">wash care</label>
                <textarea name="wash_care" id="wash_care" rows="3" class="form-control" placeholder="Enter ...">@if(!empty($product_data['wash_care'])){{$product_data['wash_care']}}@else{{old('wash_care')}}@endif</textarea>
               </div>
             </div>


              <div class="col-md-6"> 
               <div class="form-group">
                  <label>select fabric </label>
                  <select name="fabric" id="fabric" class="form-control select2" style="width: 100%;">
                    <option value="">select</option>
 @foreach($fabric_array as $fabric)
<option value="{{$fabric}}"  @if(!empty($product_data['fabric']) && $product_data['fabric']==$fabric) selected="" @endif>{{$fabric}}</option> 
@endforeach 
              </select>
                </div>
              </div>

              <div class="col-md-6"> 
                  <div class="form-group">
                  <label>select sleeve</label>
                  <select name="sleeve" id="sleeve" class="form-control select2" style="width: 100%;">
                    <option value="">select</option>
 @foreach($sleeve_array as $sleeve)
<option value="{{$sleeve}}"  @if(!empty($product_data['sleeve']) && $product_data['sleeve']==$sleeve) selected="" @endif>{{$sleeve}}</option> 
@endforeach 
              </select>
                </div>
              </div>

              <div class="col-md-6"> 
                  <div class="form-group">
                  <label>select pattern </label>
                  <select name="pattern" id="pattern" class="form-control select2" style="width: 100%;">
                    <option value="">select</option>
 @foreach($pattern_array as $pattern)
<option value="{{$pattern}}"  @if(!empty($product_data['pattern']) && $product_data['pattern']==$pattern) selected="" @endif>{{$pattern}}</option> 
@endforeach 
              </select>
                </div>
              </div>

              <div class="col-md-6"> 
                  <div class="form-group">
                  <label>select fit</label>
                  <select name="fit" id="fit" class="form-control select2" style="width: 100%;">
                    <option value="">select</option>
 @foreach($fit_array as $fit)
<option value="{{$fit}}" @if(!empty($product_data['fit']) && $product_data['fit']==$fit) selected="" @endif>{{$fit}}</option> 
@endforeach 
              </select>
                </div>

                  <div class="form-group">
                  <label>select occasion</label>
                  <select name="occassion" id="occassion" class="form-control select2" style="width: 100%;">
                    <option value="">select</option>
 @foreach($occassion_array as $occassion)
<option value="{{$occassion}}"  @if(!empty($product_data['occassion']) && $product_data['occassion']==$occassion) selected="" @endif>{{$occassion}}</option> 
@endforeach 
              </select>
                </div>
              </div>


              <div class="col-12 col-sm-6">
               	<div class="form-group">
               	<label for="meta_t">meta title</label>
               	<textarea name="meta_t" id="meta_t" rows="3" class="form-control" placeholder="Enter ..." >@if(!empty($product_data['meta_title'])){{$product_data['meta_title']}}@else{{old('meta_title')}}@endif</textarea>
               </div>
              </div>
              <div class="col-12 col-sm-6">
               	<div class="form-group">
               	<label for="meta_des">meta description</label>
               	<textarea name="meta_des" id="meta_des" rows="3" class="form-control" placeholder="Enter ...">@if(!empty($product_data['meta_description'])){{$product_data['meta_description']}}@else{{old('meta_description')}}@endif</textarea>
               </div>
              </div>

               <div class="col-12 col-sm-6">
               	<div class="form-group">
               	<label for="meta_key">meta keywords</label>
               	<textarea name="meta_key" id="meta_key" rows="3" class="form-control" placeholder="Enter ...">@if(!empty($product_data['meta_keywords'])){{$product_data['meta_keywords']}}@else{{old('meta_keywords')}} @endif</textarea>
               </div>
              </div>

              <div class="col-12 col-sm-6">
                <div class="form-group">
             <div class="form-check">
              <input type="checkbox" class="form-check-input" id="is_feature" name="is_feature" value="Yes" @if(!empty($product_data['is_featured']) && $product_data['is_featured']=='No') checked=""  @endif >
              
              <label class="form-check-label" for="is_feature">featured items</label>
               </div>
               </div>
              </div>

            </div>
          </div>
          <div class="card-footer ">
            <button type="submit" class="btn btn-primary float-right">Submit</button>
          </div>
        </div>
    </form>

      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection