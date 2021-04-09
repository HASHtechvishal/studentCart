@extends('layouts.e-com front layout.front_layout')
@section('content') 


<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">delivery addresses</li>
    </ul>
	<h3>{{$title}}</h3>	
	<hr class="soft"/>
	@if(Session::has('updated'))
	    <div class="alert alert-success" role="alert">
	    	{{Session::get('updated')}}
	    </div>
	    <?php Session::forget('updated');?>  
	@endif
	@if(Session::has('login_error'))
	    <div class="alert alert-danger" role="alert">
	    	{{Session::get('login_error')}}
	    </div> 
	    	    <?php Session::forget('updated');?>   
	@endif 

	@if($errors->any())
	    <div class="alert alert-danger" style="margin-top: 10px;">
	    	<ul>
	    		@foreach($errors->all() as $error)
	    		<li>{{$error}}</li>
	    		@endforeach
	    	</ul>
	    </div>  
	@endif

	<div class="row">
		<div class="span4"> 
			<div class="well"> 
			Enter your address details<br/><br/>
			<form id="deliveryAddress" @if(empty($address['id'])) action="{{url('add_editAddess')}}" @else action="{{url('add_editAddess/'.$address['id'])}}" @endif method="post">
				@csrf
				<div class="control-group">
				<label class="control-label" for="inputName">Name</label>
				<div class="controls">
				  <input class="span3"  type="text" name="name" id="name" placeholder="name" @if(isset($address['name'])) value="{{$address['name']}}" @else value="{{old('name')}}" @endif> 
				</div>
			  </div>

			  <div class="control-group">
				<label class="control-label" for="account">Address</label>
				<div class="controls">
				  <input class="span3"  type="text" name="address" id="address" placeholder="address" @if(isset($address['address'])) value="{{$address['address']}}" @else value="{{old('address')}}" @endif>
				</div>
			  </div><div class="control-group">
				<label class="control-label" for="city">City</label>
				<div class="controls">
				  <input class="span3"  type="text" name="city" id="city" placeholder="city" @if(isset($address['city'])) value="{{$address['city']}}" @else value="{{old('city')}}" @endif>
				</div>
			  </div><div class="control-group">
				<label class="control-label" for="state">State</label>
				<div class="controls">
				  <input class="span3"  type="text" name="state" id="state" placeholder="state" @if(isset($address['state'])) value="{{$address['state']}}" @else value="{{old('state')}}" @endif>
				</div>
			  </div><div class="control-group">
				<label class="control-label" for="country">Country</label>
				<div class="controls">
				 
				  <select class="span3" name="country" id="country">
				  	<option value="">select country</option>
@foreach($country as $regions)				  	
				  	<option value="{{$regions['country_name']}}" @if($regions['country_name']==$address['country']) selected="" @elseif($regions['country_name']==old('country')) selected="" @endif>{{$regions['country_name']}}</option>
@endforeach				  	
				  </select>
				</div>
			  </div><div class="control-group">
				<label class="control-label" for="pin">Pin code</label>
				<div class="controls">
				  <input class="span3"  type="text" name="pin" id="pin" placeholder="pin" @if(isset($address['pin'])) value="{{$address['pin']}}" @else value="{{old('pin')}}" @endif>
				</div>
			  </div>

 

			  <div class="control-group">
				<label class="control-label" for="inputMoblie0">Mobile</label>
				<div class="controls">
				  <input class="span3"  type="text" id="moblie" name="mobile" placeholder="Mobile" @if(isset($address['mobile'])) value="{{$address['mobile']}}" @else value="{{old('mobile')}}" @endif>
				</div>
			  </div>
			  
		
			  <div class="controls">
			  <button type="submit" class="btn block">submit</button>
			  <a href="{{url('checkout')}}" class="btn block" style="float: right; ">back</a>
			  </div>
			</form>
		</div>
		</div>
	</div>	
	
</div>
@endsection