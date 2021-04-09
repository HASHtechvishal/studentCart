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
              <li class="breadcrumb-item active">coupons</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section> 

    <section class="content">
      <div class="container-fluid">
        <x-e-com_alert/>
 {{--we need 2 action one for edit and other for add--}}       
        <form @if(empty($coupon['id']))action="{{url('/admin/add_edit_coupon')}}" @else action="{{url('/admin/add_edit_coupon/'.$coupon['id'])}}"  @endif  method="post" name="coupon_form" id="coupon_form" enctype="multipart/form-data">@csrf
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

    @if(empty($coupon['coupon_code'])) 
                <div class="col-md-6">        	
               <div class="form-group">
                <label for="option">coupon option</label><br>
                <span><input type="radio" name="coupon_option" value="Automatic" id="AutomaticCoupon" required="">Automatic</span>
                &nbsp;&nbsp;
                 <span><input type="radio" name="coupon_option" value="Manual" id="ManualCoupon">Manual</span>
                &nbsp;&nbsp;
                </div>
             </div>

              <div class="col-md-6"> 
               <div class="form-group" style="display: none;" id="couponField">
                <label for="coupon_code">coupon code</label>
                <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="enter coupon code">
               </div>
             </div>
    @else     
    

              <div class="col-md-6"> 
               <div class="form-group">
                <label for="coupon_code">coupon code</label>
                <span>{{$coupon['coupon_code']}}</span>
               </div>
             </div>    
    @endif
<input type="hidden" name="coupon_option" value="{{$coupon['coupon_option']}}">
<input type="hidden" name="coupon_code" value="{{$coupon['coupon_code']}}">

             <div class="col-md-6"> 
               <div class="form-group">
                <label for="type">coupon type</label><br>
                <span><input type="radio" name="coupon_type" value="multiple times" @if(isset($coupon['coupon_type'])&&$coupon['coupon_type']=="multiple times") checked="" @endif>multiple times</span>
                &nbsp;&nbsp;
                 <span><input type="radio" name="coupon_type" value="single times" @if(isset($coupon['coupon_type'])&&$coupon['coupon_type']=="single times") checked="" @endif>single times</span>
                &nbsp;&nbsp;
                </div>
             </div>

             <div class="col-md-6"> 
               <div class="form-group">
                <label for="amount">amount type</label><br>
                <span><input type="radio" name="amount_type" value="percentage" @if(isset($coupon['amount_type'])&&$coupon['amount_type']=="percentage") checked="" @endif>percentage</span>
                &nbsp;(%)&nbsp;
                 <span><input type="radio" name="amount_type" value="Fixed" @if(isset($coupon['amount_type'])&&$coupon['amount_type']=="Fixed") checked="" @endif>Fixed</span>
                &nbsp;(INR or USD)&nbsp;
                </div>
             </div>


             <div class="col-md-6"> 
               <div class="form-group">
                <label for="amount">enter amount</label>
                <input type="text" name="amount" id="amount" class="form-control" placeholder="enter amount" @if(isset($coupon['amount'])) value="{{$coupon['amount']}}" @endif>
               </div>
             </div>


             <div class="col-md-6"> 
               <div class="form-group">
                <label for="categories">select catogories</label>
                <select name="category[]" class="form-control select2" multiple="">
                    <option value="">select</option>
 @foreach($categories as $section)
 <optgroup label="{{$section['name']}}"></optgroup>{{--optgroup which dont selected--}}
 @foreach($section['categories'] as $category) 
 <option value="{{$category['id']}}" @if(in_array($category['id'],$selCats)) selected="" @endif>&nbsp;&nbsp;&nbsp;{{$category['category_name']}}</option>

 @foreach($category['sub_categories'] as $subcategory)
 <option value="{{$subcategory['id']}}" @if(in_array($subcategory['id'],$selCats)) selected="" @endif>&nbsp;&nbsp;&nbsp;>>&nbsp;&nbsp;{{$subcategory['category_name']}}</option> 
 @endforeach
 @endforeach
 @endforeach                   
                    </select>
               </div>
             </div>


             <div class="col-md-6"> 
               <div class="form-group">
                <label for="users">select users</label>
                <select name="users[]" class="form-control select2" multiple="" data-live-search="true">
                    <option value="">select</option>
 @foreach($users as $user)
                   <option value="{{$user['email']}}" @if(in_array($user['email'],$selUsers)) selected="" @endif>{{$user['email']}}</option>
 @endforeach                   
                    </select>
               </div> 
             </div>


<div class="col-md-6"> 
               <div class="form-group">
                <label for="date">Expiry Date</label>
                <input type="text" name="expiry_date" id="expiry_date" class="form-control" placeholder="enter coupon expiry date" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask required="" @if(isset($coupon['expiry_data'])) value="{{$coupon['expiry_data']}}" @endif> 
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