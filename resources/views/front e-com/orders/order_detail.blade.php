<?php use App\Product; ?>
@extends('layouts.e-com front layout.front_layout')
@section('content') 


<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Orders</li>
    </ul>
	<h3>Order #{{$orderDetails['id']}} Details</h3>	
	<hr class="soft"/>

	<div class="row">
		<div class="span4"> 
		  <table class="table table-striped table-bordered">
		  	<tr>
		  		<td colspan="2"><strong>Order Details</strong></td>
		  	</tr>
		  	<tr>
		  		<td>Order Date</td>
		  		<td>{{date('d-m-Y',strtotime($orderDetails['created_at']))}}</td>
		  	</tr>
		  	<tr>
		  		<td>Order Status</td>
		  		<td>{{$orderDetails['order_status']}}</td>
		  	</tr>
		  	<tr>{{--add if statement if courier is empty--}}
		  		<td>Courier Name</td>
		  		<td>{{$orderDetails['courier_name']}}</td>
		  	</tr>
		  	<tr>
		  		<td>Tracking Number</td>
		  		<td>{{$orderDetails['tracking_number']}}</td>
		  	</tr>
		  	<tr>
		  		<td>Order Total</td>
		  		<td>{{$orderDetails['grand_total']}}</td>
		  	</tr>
		  	<tr>
		  		<td>Order Charges</td>
		  		<td>{{$orderDetails['shipping_charges']}}</td>
		  	</tr>
		  	<tr>
		  		<td>Order Amount</td>
		  		<td>{{$orderDetails['coupon_amount']}}</td>
		  	</tr>
		  	<tr>
		  		<td>Payment Method</td>
		  		<td>{{$orderDetails['payment_method']}}</td>
		  	</tr>
		  </table>
		</div> 

		<div class="span4"> 
		  <table class="table table-striped table-bordered">
		  	<tr>
		  		<td colspan="2"><strong>Delivery Address</strong></td>
		  	</tr>
		  	<tr>
		  		<td>Name</td>
		  		<td>{{$orderDetails['name']}}</td>
		  	</tr>
		  	<tr>
		  		<td>Address</td>
		  		<td>{{$orderDetails['address']}}</td>
		  	</tr>
		  	<tr>
		  		<td>City</td>
		  		<td>{{$orderDetails['city']}}</td>
		  	</tr>
		  	<tr>
		  		<td>State</td>
		  		<td>{{$orderDetails['state']}}</td>
		  	</tr>
		  	<tr>
		  		<td>Country</td>
		  		<td>{{$orderDetails['country']}}</td>
		  	</tr>
		  	<tr>
		  		<td>Pincode</td>
		  		<td>{{$orderDetails['pincode']}}</td>
		  	</tr>
		  	<tr>
		  		<td>Mobile</td>
		  		<td>{{$orderDetails['mobile']}}</td>
		  	</tr>
		  </table>
		</div>
	</div>	 	
	

	<div class="row">
		<div class="span8"> 
		  <table class="table table-striped table-bordered">
		  	<tr>
		  		<th>Product Image</th>
		  		<th>Product Code</th>
		  		<th>Product Name</th>
		  		<th>Product Size</th>
		  		<th>Product Color</th>
		  		<th>Product Qty</th>
		  	</tr>
	@foreach($orderDetails['orders_products'] as $product)
	<tr>
		        <td><?php $getProductImage =  Product::getProductImage($product['product_id'])?>
		        	<a target="_blank" href="{{url('product_details/'.$product['product_id'])}}"><img style="width: 60px;" src="{{asset('e-com images/product images/small_img/'.$getProductImage)}}" alt="pro_img"></a>
		        </td>
		  		<td>{{$product['product_code']}}</td>
		  		<td>{{$product['product_name']}}</td>
		  		<td>{{$product['product_size']}}</td> 
		  		<td>{{$product['product_color']}}</td>
		  		<td>{{$product['product_qty']}}</td>
	</tr>
	@endforeach	  		  	
		  </table>
	</div>	
	
</div>



@endsection