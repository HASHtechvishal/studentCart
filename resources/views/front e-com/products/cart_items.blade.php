<?php use App\Product; ?>
<table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product</th>
                  <th colspan="2">Description</th>
                  <th>Quantity/Update</th>
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
					<div class="input-append"><input class="span1" style="max-width:34px" value="{{$item['quantity']}}" id="appendedInputButtons" size="16" type="text">
            <button class="btn btnItemUpdate qtyMinus" type="button" data-cartid="{{$item['id']}}"><i class="icon-minus"></i>
            </button>
            <button class="btn btnItemUpdate qtyPlus" type="button" data-cartid="{{$item['id']}}"><i class="icon-plus"></i>
            </button>
            <button class="btn btn-danger btnItemDelete" type="button" data-cartid="{{$item['id']}}"><i class="icon-remove icon-white"></i>
            </button>				
          </div>
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
                      @else
                          Rs. 0
                      @endif
                  </td>
                </tr>
                
				 <tr>
                  <td colspan="6" style="text-align:right"><strong>GRAND TOTAL (Rs.{{$total_price}} - <span class="couponAmount">Rs.0</span>) =</strong></td>
                  <td class="label label-important" style="display:block"> <strong class="grand_total"> Rs.{{$total_price - Session::get('couponAmount')}} </strong></td>
                </tr>
				</tbody>
            </table>