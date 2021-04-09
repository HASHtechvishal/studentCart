<?php use App\Product; ?>
<div class="tab-pane  active" id="blockView">
					<ul class="thumbnails">
				@foreach($category_pro as $product)		
						<li class="span3">
							<div class="thumbnail" style="">
								<a href="{{url('product_details/'.$product['id'])}}">
		@if(isset($product['main_image']))					
				<?php $product_image_path = 'e-com images/product images/small_img/'.$product['main_image']; ?>
		@else
				<?php $product_image_path = ""; ?>
		@endif
@if(!empty($product['main_image']) && file_exists($product_image_path))
<img src="{{asset($product_image_path)}}" alt="">
									@else
<img src="{{asset('e-com images/product images/small_img/no_image.png')}}" alt="">
									@endif
	</a>
<div class="caption">
	<h5>{{$product['product_name']}}</h5>
				<p>
	{{$product['brand']['name']}}
		</p>
<?php $discounted_price = Product::getDiscountrPrice($product['id']);?>		
<h4 style="text-align:center"><a class="btn" href="{{url('product_details/'.$product['id'])}}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">
@if($discounted_price>0)
	<del>Rs.{{$product['product_price']}}</del>
@else
    Rs.{{$product['product_price']}}
@endif    
</a></h4>
@if($discounted_price>0)
  <h4 style="color: red">Discounted Price : {{$discounted_price}}</h4>
@endif
<p>
	{{$product['fabric']}}
</p>
<p>
	{{$product['sleeve']}}
</p>
<p>
	{{$product['pattern']}}
</p>
<p>
	{{$product['fit']}}
</p>
<p>
	{{$product['occassion']}}
</p>
		</div>
		</div>
		</li>
	@endforeach		
						
	</ul>
<hr class="soft"/>
	</div>