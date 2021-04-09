@extends('layouts.e-com front layout.front_layout')
@section('content') 


<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Login</li>
    </ul>
	<h3>My Account</h3>	
	<hr class="soft"/>
	@if(Session::has('updated'))
	    <div class="alert alert-success" role="alert">
	    	{{Session::get('updated')}}
	    </div>  
	@endif
	@if(Session::has('login_error'))
	    <div class="alert alert-danger" role="alert">
	    	{{Session::get('login_error')}}
	    </div>  
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
			<h5>ACCOUNT</h5><br/>
			Enter your details<br/><br/>
			<form id="accountForm" action="{{url('account')}}" method="post">
				@csrf
				<div class="control-group">
				<label class="control-label" for="inputName">Name</label>
				<div class="controls">
				  <input class="span3"  type="text" name="name" id="name" placeholder="name" value="{{$userDetails['name']}}"> 
				</div>
			  </div>

			  <div class="control-group">
				<label class="control-label" for="account">Address</label>
				<div class="controls">
				  <input class="span3"  type="text" name="address" id="address" placeholder="address" value="{{$userDetails['address']}}">
				</div>
			  </div><div class="control-group">
				<label class="control-label" for="city">City</label>
				<div class="controls">
				  <input class="span3"  type="text" name="city" id="city" placeholder="city" value="{{$userDetails['city']}}">
				</div>
			  </div><div class="control-group">
				<label class="control-label" for="state">State</label>
				<div class="controls">
				  <input class="span3"  type="text" name="state" id="state" placeholder="state" value="{{$userDetails['state']}}">
				</div>
			  </div><div class="control-group">
				<label class="control-label" for="country">Country</label>
				<div class="controls">
				 
				  <select class="span3" name="country" id="country">
				  	<option value="">select country</option>
	@foreach($country as $regions)			  	
				  	<option value="{{$regions['country_name']}}" @if($regions['country_name']==$userDetails['country']) selected="" @endif>{{$regions['country_name']}}</option>
	@endforeach			  	
				  </select>
				</div>
			  </div><div class="control-group">
				<label class="control-label" for="pin">Pin code</label>
				<div class="controls">
				  <input class="span3"  type="text" name="pin" id="pin" placeholder="pin" value="{{$userDetails['pincode']}}">
				</div>
			  </div>

 

			  <div class="control-group">
				<label class="control-label" for="inputMoblie0">Mobile</label>
				<div class="controls">
				  <input class="span3"  type="text" id="moblie" name="mobile" placeholder="Mobile" value="{{$userDetails['mobile']}}">
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="inputEmail0">E-mail address</label>
				<div class="controls">
				  <input class="span3"  type="email" value="{{$userDetails['email']}}" readonly="">
				</div>
			  </div>
		
			  <div class="controls">
			  <button type="submit" class="btn block">Update</button>
			  </div>
			</form>
		</div>
		</div>
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
			<h5>Update Password</h5>
			<form id="passwordForm" action="{{url('/update-user-password')}}" method="post">@csrf 

			  <div class="control-group">
				<label class="control-label" for="currentPassword">Current Password</label>
				<div class="controls">
				  <input type="password" class="span3"  id="current_pwd" name="current_pwd" placeholder="Current Password">
				  <p id="chkPwd"></p>
				</div>
			  </div><div class="control-group">
				<label class="control-label" for="newPassword">New Password</label>
				<div class="controls">
				  <input type="password" class="span3"  id="new_pwd" name="new_pwd" placeholder="New Password">
				</div>
			  </div><div class="control-group">
				<label class="control-label" for="confirmPassword">Confirm Password</label>
				<div class="controls">
				  <input type="password" class="span3"  id="confirm_pwd" name="confirm_pwd" placeholder="Confirm Password">
				</div>
			  </div>

 
			  <div class="control-group">
				<div class="controls">
				  <button type="submit" class="btn">Update</button> 
				</div>
			  </div>
			</form>
		</div>
		</div>
	</div>	
	
</div>



@endsection