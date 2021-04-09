<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>order email</title>
</head>
<body>
	<table style="width: 700px;">
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td><img src="{{asset('e-com images/front images/logo1.png')}}" alt=""></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>hello {{$name}},</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>your order #{{$order_id}} status has been updated to {{$order_status}}</td>
		</tr>
@if(!empty($courier_name) && !empty($tracking_number))		
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>courier name is {{$courier_name}} and tracking number is {{$tracking_number}}</td>
		</tr>
@endif		
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
				<table style="width: 95%" cellpadding="5" bgcolor="#f7f4f4">
				<tr bgcolor="#cccccc">
					<td>product name</td>
					<td>product code</td>
					<td>product size</td>
					<td>product color</td>
					<td>product quantity</td>
					<td>product price</td>
				</tr>
	@foreach($orderDetails['orders_products'] as $order)
	            <tr>
					<td>{{$order['product_name']}}</td>
					<td>{{$order['product_code']}}</td>
					<td>{{$order['product_size']}}</td>
					<td>{{$order['product_color']}}</td>
					<td>{{$order['product_qty']}}</td>
					<td>{{$order['product_price']}}</td>
				</tr>
	@endforeach
	            <tr>
					<td colspan="5" align="right">Shippind charges</td>
					<td>{{$orderDetails['shipping_charges']}}</td>
				</tr>
				<tr>
					<td colspan="5" align="right">Coupon Discount</td>
					<td>{{$orderDetails['coupon_amount']}}</td>
				</tr>
				<tr>
					<td colspan="5" align="right">Grand total</td>
					<td>{{$orderDetails['grand_total']}}</td>
				</tr>
				</table>
				<tr>
			        <td>&nbsp;</td>
		        </tr>
		        <tr>
		        	<td><table>
		        		<tr>
		        			<td><strong>Delivery address</strong></td>
		        		</tr>
		        		<tr>
		        			<td>{{$orderDetails['name']}}</td>
		        		</tr>
		        		<tr>
		        			<td>{{$orderDetails['address']}}</td>
		        		</tr>
		        		<tr>
		        			<td>{{$orderDetails['city']}}</td>
		        		</tr>
		        		<tr>
		        			<td>{{$orderDetails['state']}}</td>
		        		</tr>
		        		<tr>
		        			<td>{{$orderDetails['country']}}</td>
		        		</tr>
		        		<tr>
		        			<td>{{$orderDetails['pincode']}}</td>
		        		</tr>
		        		<tr>
		        			<td>{{$orderDetails['mobile']}}</td>
		        		</tr>
		        	</table></td>
		        </tr>
		        <tr>
			        <td>&nbsp;</td>
		        </tr>	
		        <tr>
			        <td>for any enquiries contact us</td>
		        </tr>	
		        <tr>
			        <td>&nbsp;</td>
		        </tr>	
		        <tr>
			        <td>regards<br>team stack developre</td>
		        </tr>	
		        <tr>
			        <td>&nbsp;</td>
		        </tr>
		</td>
		</tr>
	</table>
</body>
</html>