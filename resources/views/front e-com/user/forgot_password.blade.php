@extends('layouts.e-com front layout.front_layout')
@section('content')


<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Login</li>
    </ul>
	<h3>forgot password</h3>	
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
	<div class="row">
		<div class="span4"> 
			<div class="well">
			<h5>FORGOT PASSWORD</h5><br/>
			Enter your email to create new password.<br/><br/>
			<form id="forgotPasswordForm" action="{{url('/forgot_password')}}" method="post">
				@csrf
			  <div class="control-group">
				<label class="control-label" for="inputEmail0">E-mail address</label>
				<div class="controls">
				  <input class="span3"  type="email" id="email" name="email" placeholder="Email" required="">
				</div>
			  </div>
			  <div class="controls">
			  <button type="submit" class="btn block">Submit</button>
			  </div>
			</form>
		</div>
		</div>
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
			<h5>LOGIN</h5>
			<form id="loginForm" action="{{url('/login')}}" method="post">@csrf 
			  <div class="control-group">
				<label class="control-label" for="inputEmail1">Email</label>
				<div class="controls">
				  <input class="span3" name="email" type="text" id="email" placeholder="Email">
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="inputPassword1">Password</label>
				<div class="controls">
				  <input type="password" class="span3"  id="password" name="password" placeholder="Password">
				</div>
			  </div>
			  <div class="control-group">
				<div class="controls">
				  <button type="submit" class="btn">Sign in</button> <a href="{{url('forgot_password')}}">Forgot password?</a>
				</div>
			  </div>
			</form>
		</div>
		</div>
	</div>	
	
</div>



@endsection