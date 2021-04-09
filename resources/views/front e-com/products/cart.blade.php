<?php 
use App\Cart; 
?>
@extends('layouts.e-com front layout.front_layout')
@section('content')


	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active"> SHOPPING CART</li>
    </ul>
	<h3>  SHOPPING CART [ <small><span class="totalCartItems">{{totalCartItems()}}</span> Item(s) </small>]<a href="{{url('/')}}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
	<hr class="soft"/> 
	{{--<table class="table table-bordered">
		<tr><th> I AM ALREADY REGISTERED  </th></tr>
		 <tr> 
		 <td>
			<form class="form-horizontal">
				<div class="control-group">
				  <label class="control-label" for="inputUsername">Username</label>
				  <div class="controls">
					<input type="text" id="inputUsername" placeholder="Username">
				  </div> 
				</div>
				<div class="control-group">
				  <label class="control-label" for="inputPassword1">Password</label>
				  <div class="controls">
					<input type="password" id="inputPassword1" placeholder="Password">
				  </div>
				</div>
				<div class="control-group">
				  <div class="controls">
					<button type="submit" class="btn">Sign in</button> OR <a href="register.html" class="btn">Register Now!</a>
				  </div>
				</div>
				<div class="control-group">
					<div class="controls">
					  <a href="forgetpass.html" style="text-decoration:underline">Forgot password ?</a>
					</div>
				</div> 
			</form> 
		  </td>
		  </tr>
	</table>--}}		
        <x-e-com_alert/>


<div id="AppendCartItems">
	@include('front e-com.products.cart_items')
</div>

		
		
            <table class="table table-bordered">
			<tbody>
				 <tr>
                  <td> 
				<form id="ApplyCoupon" method="post" action="javascript:void(0);" class="form-horizontal" @if(Auth::check()) user="1" @endif>@csrf
				<div class="control-group">
				<label class="control-label"><strong> COUPON CODE: </strong> </label>
				<div class="controls">
				<input name="code" id="code" type="text" class="input-medium" placeholder="CODE" value="{{old('code')}}" required="">
				<button type="submit" class="btn"> APPLY </button>
				</div>
				</div>
				</form>
				</td>
                </tr>
				
			</tbody>
			</table>


			
			<!-- <table class="table table-bordered">
			 <tr><th>ESTIMATE YOUR SHIPPING </th></tr>
			 <tr> 
			 <td>
				<form class="form-horizontal">
				  <div class="control-group">
					<label class="control-label" for="inputCountry">Country </label>
					<div class="controls">
					  <input type="text" id="inputCountry" placeholder="Country">
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label" for="inputPost">Post Code/ Zipcode </label>
					<div class="controls">
					  <input type="text" id="inputPost" placeholder="Postcode">
					</div>
				  </div>
				  <div class="control-group">
					<div class="controls">
					  <button type="submit" class="btn">ESTIMATE </button>
					</div>
				  </div>
				</form>				  
			  </td>
			  </tr>
            </table> -->		
	<a href="{{url('/')}}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping</a>
	<a href="{{url('/checkout')}}" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
	
</div>



@endsection