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

    <section class="content">
      <div class="container-fluid">
        <x-e-com_alert/>
 {{--we need 2 action one for edit and other for add--}}       
        <form @if(empty($banner_data['id']))action="{{url('/admin/add_edit_banner')}}" @else action="{{url('/admin/add_edit_banner/'.$banner_data['id'])}}"  @endif  method="post" name="banner_form" id="banner_form" enctype="multipart/form-data">@csrf
          {{--as id will not come for add banner--}}
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
                <label for="image">banner main image</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label for="image" class="custom-file-label">choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text" id="">upload</span>
                  </div>
                </div>
                <div style="color: green">recommended image size:&nbsp;width:1170px, height:480px</div>
@if(!empty($banner_data['image']))
 <div>
 <img style="width: 100px; margin-top:5px;" src="{{asset('e-com images/banner images/'.$banner_data['image'])}}" alt="image">&nbsp;
 
</div>
@endif                 
               </div>
             </div>


              <div class="col-md-6"> 
               <div class="form-group">
                <label for="link">banner link</label>
                <input type="text" name="link" id="link" class="form-control" placeholder="enter banner link"
                @if(!empty($banner_data['link'])) value="{{$banner_data['link']}}" @else value="{{old('link')}}" @endif>
               </div>
             </div>

              

             
              <div class="col-md-6"> 
               <div class="form-group">
                <label for="title">banner title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="enter banner title"
                @if(!empty($banner_data['title'])) value="{{$banner_data['title']}}" @else value="{{old('title')}}" @endif>
               </div>
             </div>

                       
        
             <div class="col-md-6"> 
               <div class="form-group">
                <label for="alt">banner alternative text</label>
                <input type="text" name="alt" id="alt" class="form-control" placeholder="enter banner alt"
                @if(!empty($banner_data['alt'])) value="{{$banner_data['alt']}}" @else value="{{old('alt')}}" @endif>
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