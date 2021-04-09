@extends('layouts.e-com front layout.front_layout')
@section('content')


<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Login</li>
    </ul>
	<h3> Login/register</h3>	
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
			<h5>CREATE YOUR ACCOUNT</h5><br/>
			Enter your details to create an account.<br/><br/>
			<form id="registerForm" action="{{url('/register')}}" method="post">
				@csrf
				<div class="control-group">
				<label class="control-label" for="inputName">Name</label>
				<div class="controls">
				  <input class="span3"  type="text" name="name" id="name" placeholder="name">
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="inputMoblie0">Mobile</label>
				<div class="controls">
				  <input class="span3"  type="text" id="moblie" name="mobile" placeholder="Mobile">
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="inputEmail0">E-mail address</label>
				<div class="controls">
				  <input class="span3"  type="email" id="email" name="email" placeholder="Email">
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="inputpassword0">Enter Password</label>
				<div class="controls">
				  <input class="span3"  type="password" id="password" name="password" placeholder="Password">
				</div>
			  </div>
			  <div class="controls">
			  <button type="submit" class="btn block">Create Your Account</button>
			  </div>
			</form>
		</div>
		</div>
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
			<h5>ALREADY REGISTERED ?</h5>
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