 @extends('layouts.e-com front layout.front_layout')
@section('content') 


<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
		<li class="active">Orders</li>
    </ul>
	<h3>Orders</h3>	
	<hr class="soft"/>
	

	<div class="row">
		<div class="span8"> 
		  <table class="table table-striped table-bordered">
		  	<tr>
		  		<th>order id</th>
		  		<th>order products</th>
		  		<th>Payment Method</th>
		  		<th>Grand Total</th>
		  		<th>Created on</th>
		  		<th>Order Details</th>
		  	</tr>
	@foreach($orders as $order)
	<tr>
		  		<td>{{$order['id']}}</td>
		  		<td>
		  			@foreach($order['orders_products'] as $product)
		  			  {{$product['product_code']}} <br>
		  			@endforeach
		  		</td>
		  		<td>{{$order['payment_method']}}</td> 
		  		<td>{{$order['grand_total']}}</td>
		  		<td>{{date('d-m-Y',strtotime($order['created_at']))}}</td>
		  		<td><a href="{{url('orders/'.$order['id'])}}">View</a></td>
		  	</tr>
	@endforeach	  		  	
		  </table>
	</div>	
	
</div>



@endsection