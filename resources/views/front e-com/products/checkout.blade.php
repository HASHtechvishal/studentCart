<?php 
use App\Cart;
use App\Product; 
?>
@extends('layouts.e-com front layout.front_layout')
@section('content')


	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active"> CHECKOUT</li>
    </ul>
	<h3>  CHECKOUT [ <small><span class="totalCartItems">{{totalCartItems()}}</span> Item(s) </small>]<a href="{{url('/cart ')}}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i>back to cart</a></h3>	
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
	</table>.         
 --}}		
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

<form action="{{url('checkout')}}" method="post" name="checkoutForm" id="checkoutForm">@csrf
<table class="table table-bordered">
		<tr><td><strong>DELIVERY ADDRESSES</strong> | <a href="{{url('add_editAddess')}}" class="btn">Add Address</a></td></tr>
@foreach($deliveryAddress as $addresses)		
		 <tr> 
		 <td>
				<div class="control-group" style="float:left; margin-top: -2px; margin-right: 5px;" >
					<input type="radio" id="address{{$addresses['id']}}" name="address_id" value="{{$addresses['id']}}">
				</div>
				<div class="control-group">
				  <label class="control-label" for="inputPassword1">{{$addresses['name']}}, {{$addresses['address']}}, {{$addresses['city']}}, {{$addresses['state']}}, {{$addresses['country']}}</label>
				</div>
		  </td>
		  <td><a href="{{url('add_editAddess/'.$addresses['id'])}}" class="btn">Edit</a> | <a href="{{url('DeleteAddess/'.$addresses['id'])}}" class="btn addressDelete">Delete</a></td>
		  </tr> 
@endforeach		  
	</table>



<table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product</th>
                  <th colspan="2">Description</th>
                  <th>Quantity</th>
				  <th>unit Price</th>
                  <th>Discount</th>
                  <th>sub Total</th>
				</tr>
              </thead>
              <tbody>

<?php $total_price = 0; ?>
@foreach($userCartItems as $item)
{{--<?php $AttrPrice = Cart::getProductAttrPrice($item['product_id'],$item['size']); ?>--}} 

<?php $AttrPrice = Product::getDiscountedAttrPrice($item['product_id'],$item['size']); ?>              	
 
                <tr>
                  <td> <img width="60" src="{{asset('e-com images/product images/small_img/'.$item['product']['main_image'])}}" alt=""/></td>
                   <td colspan="2">{{$item['product']['product_name']}}<br/>Color : {{$item['product']['product_color']}}
                  	<br>
                  Size : {{$item['size']}} <br>
                  Code : {{$item['product']['product_code']}} 	
                  </td>
				  <td>
		 	{{$item['quantity']}}
				  </td>
                  <td>Rs.{{$AttrPrice['product_price']}}</td>
                  <td>Rs.{{$AttrPrice['discount']}}</td>
                  <td>Rs.{{$AttrPrice['discounted_price'] * $item['quantity']}}</td>
                </tr>
 <?php $total_price = $total_price + ($AttrPrice['discounted_price'] * $item['quantity']); ?>               
@endforeach                

                <tr>
                  <td colspan="6" style="text-align:right">Total Price:	</td>
                  <td> Rs.{{$total_price}}</td>
                </tr>

				 <tr>
                  <td colspan="6" style="text-align:right">Voucher Discount:</td>
                  <td class="couponAmount">
                    @if(Session::has('couponAmount'))
                         - Rs. {{Session::get('couponAmount')}}
                         {{Session::forget('couponAmount')}}
                      @else
                          Rs. 0
                      @endif
                  </td>
                </tr>
                
				 <tr>
                  <td colspan="6" style="text-align:right"><strong>GRAND TOTAL (Rs.{{$total_price}} - <span class="couponAmount">Rs.0</span>) =</strong></td>
                  <td class="label label-important" style="display:block"> <strong class="grand_total"> Rs.{{$grand_total = $total_price - Session::get('couponAmount')}}
<?php Session::put('grand_total', $grand_total); ?>
                   </strong></td>
                </tr>
				</tbody>
            </table>

		
		
            <table class="table table-bordered">
			<tbody>
				 <tr>
                  <td> 
				<div class="control-group">
				<label class="control-label"><strong> PAYMENT METHODS: </strong> </label>
				<div class="controls">	
 <div>
 	<input type="radio" name="payment_method" id="cod" value="COD"><strong>COD</strong>
 	<input type="radio" name="payment_method" id="paypal" value="paypal"><strong>Paypal</strong>
 </div>
				</div>
				</div>
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
	<a href="{{url('cart')}}" class="btn btn-large"><i class="icon-arrow-left"></i> back to card</a>
	<button class="btn btn-large pull-right" type="submit">place order <i class="icon-arrow-right"></i></button>
	</form>
</div>
@endsection