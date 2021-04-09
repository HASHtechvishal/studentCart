 @extends('layouts.e-com front layout.front_layout')
@section('content')


	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active"> THANKS</li>
    </ul>
	<h3>  THANKS  </h3>	
	<hr class="soft"/> 
	<div align="center">
		<h3>YOUR ORDER HAS BEEN PLACED SUCCESSFULLY</h3>
			<p>your order number is {{Session::get('order_id')}} and grand total is INR {{Session::get('grand_total')}}</p>
	</div>
</div>
@endsection

<?php 
Session::forget('grand_total');
Session::forget('order_id');
?>