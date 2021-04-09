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

    <section class="content">
      <div class="container-fluid">
        <x-e-com_alert/>
 {{--we need 2 action one for edit and other for add--}}       
      	<form @if(empty($edit_cate['id']))action="{{url('/admin/add_edit_category')}}" @else action="{{url('/admin/add_edit_category/'.$edit_cate['id'])}}"  @endif  method="post" name="cate_form" id="cate_form" enctype="multipart/form-data">@csrf
      		{{--as id will not come for add category--}}
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{$title}}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
              	 <div class="form-group">
               	<label for="category_name">category name</label>
               	<input type="text" name="cate_name" id="cate_id" class="form-control" placeholder="enter category" @if(!empty($edit_cate['category_name'])) value="{{$edit_cate['category_name']}}" @else value="{{old('category_name')}}" @endif>
 {{--old function use for old validation for add data--}}               
               </div>
               
               <div id="cate_level">
                 @include('admin dashboard.admin category.admin_category_level')
               </div>

              </div>
              <!-- /.col -->
              <div class="col-md-6">
              	 <div class="form-group">
                  <label>select section</label>
                  <select name="section_name" id="section_id" class="form-control select2" style="width: 100%;">
                    <option value="">select</option>
                    @foreach($get_section as $section)
                    <option value="{{$section->id}}" @if(!empty($edit_cate['section_id']) && $edit_cate['section_id']==$section->id) selected @endif>{{$section->name}}</option>
                    @endforeach
                    </select>  
                </div>

               <div class="form-group">
               	<label for="cate_img">category image</label>
               	<div class="input-group">
               		<div class="custom-file">
               			<input type="file" class="custom-file-input" id="cate_img" name="cate_img">
               			<label for="cate_img" class="custom-file-label">choose file</label>
               		</div>
               		<div class="input-group-append">
               			<span class="input-group-text" id="">upload</span>
               		</div>
               	</div>
  {{--edit or delet image  -take category image field for fetching image as relation--}}
 @if(!empty($edit_cate['category_image']))
 <div>
 <img style="width: 80px; margin-top:5px;" src="{{asset('e-com images/category images/'.$edit_cate['category_image'])}}" alt="image">&nbsp;
 <a href="javascript:void(0)" class="confirmDelete" record="delete_category_image" recordid="{{$edit_cate['id']}}"{{--href="{{url('admin/delete_category_image/'.$edit_cate['id'])}}"--}}>delete image</a>
</div>
@endif                
               </div>
              </div> 
             </div>
          
            <div class="row">
              <div class="col-12 col-sm-6">
              	<div class="form-group">
               	<label for="category_name">category discount</label>
               	<input type="text" name="cate_dis" id="cate_dis" class="form-control" placeholder="enter category"
                @if(!empty($edit_cate['category_discount'])) value="{{$edit_cate['category_discount']}}" @else value="{{old('category_discount')}}" @endif>
               </div>
               	<div class="form-group">
               	<label for="category_name">category description</label>
               	<textarea name="cate_des" id="cate_des" rows="3" class="form-control" placeholder="Enter ...">@if(!empty($edit_cate['description'])){{$edit_cate['description']}}@else{{old('description')}}@endif</textarea>
               </div>
              </div>
              <div class="col-12 col-sm-6">
               	<div class="form-group">
               	<label for="category_name">category URL</label>
               	<input type="text" name="cate_url" id="cate_url" class="form-control" placeholder="enter category"
                @if(!empty($edit_cate['url'])) value="{{$edit_cate['url']}}" @else value="{{old('url')}}" @endif>
               </div>
               	<div class="form-group">
               	<label for="category_name">meta title</label>
               	<textarea name="meta_t" id="meta_t" rows="3" class="form-control" placeholder="Enter ..." >@if(!empty($edit_cate['meta_title'])){{$edit_cate['meta_title']}}@else{{old('meta_title')}}@endif</textarea>
               </div>
              </div>
              <div class="col-12 col-sm-6">
               	<div class="form-group">
               	<label for="category_name">meta description</label>
               	<textarea name="meta_des" id="meta_des" rows="3" class="form-control" placeholder="Enter ...">@if(!empty($edit_cate['meta_description'])){{$edit_cate['meta_description']}}@else{{old('meta_description')}}@endif</textarea>
               </div>
               	
              </div>
               <div class="col-12 col-sm-6">
               
               	<div class="form-group">
               	<label for="category_name">meta keywords</label>
               	<textarea name="meta_key" id="meta_key" rows="3" class="form-control" placeholder="Enter ..." >@if(!empty($edit_cate['meta_keywords'])){{$edit_cate['meta_keywords']}}@else{{old('meta_keywords')}} @endif</textarea>
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