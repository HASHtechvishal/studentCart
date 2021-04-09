<?php use App\Product; ?>
@extends('layouts.e-com front layout.front_layout')
@section('content')
<div class="span9">
<div class="well well-small">
<h4>Featured Products <small class="pull-right">{{$featured_item_count}}+ featured products</small></h4>
<div class="row-fluid">
<div id="featured" @if ($featured_item_count >4)class="carousel slide" @endif>
<div class="carousel-inner">

@foreach($featured_item_chunk as $key => $featured_item)
<div class="item @if($key == 1) active @endif">
<ul class="thumbnails">

@foreach($featured_item as $item)
<li class="span3">
<div class="thumbnail">
<i class="tag"></i>
<a href="{{url('product_details/'.$item['id'])}}">

<?php $product_image_path = 'e-com images/product images/small_img/'.$item['main_image']; ?>
@if(!empty($item['main_image']) &&
file_exists($product_image_path))
	<img src="{{asset('e-com images/product images/small_img/'.$item['main_image'])}}" alt="">
@else
	<img src="{{asset('e-com images/product images/small_img/no_image.png')}}" alt="">

@endif	  

</a>
<div class="caption">
<?php $discounted_price = Product::getDiscountrPrice($item['id']);?>		
<h5>{{$item['product_name']}}</h5>
<h4><a class="btn" href="{{url('product_details/'.$item['id'])}}">VIEW</a> <span class="pull-right" style="font-size: 14px;">
@if($discounted_price>0)
  <del>Rs.{{$item['product_price']}}</del> <span style="color: red;">Rs.{{$discounted_price}}</span>
@else
  Rs. {{$item['product_price']}}
@endif  
</span></h4>
</div>
</div>
</li>
@endforeach

</ul>
</div>
@endforeach
</div>

<a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
<a class="right carousel-control" href="#featured" data-slide="next">›</a>
						</div>
					</div>
				</div>
				<h4>Latest Products </h4>
				<ul class="thumbnails">



 @foreach($newProduct as $product)
					<li class="span3">
		<div class="thumbnail">
<a  href="{{url('product_details/'.$product['id'])}}"><?php $product_image_path = 'e-com images/product images/small_img/'.$product['main_image']; ?>
@if(!empty($product['main_image']) &&
file_exists($product_image_path))
	<img style="width: 150px;" src="{{asset('e-com images/product images/small_img/'.$product['main_image'])}}" alt="">
@else
	<img style="width: 150px;" src="{{asset('e-com images/product images/small_img/no_image.png')}}" alt="">

@endif</a>
							<div class="caption">
		<h5>{{$product['product_name']}}</h5>
		<p><b>Code-</b>{{$product['product_code']}}
	({{$product['product_color']}})
	</p>

<?php $discounted_price = Product::getDiscountrPrice($product ['id']);?>			
<h4 style="text-align:center"><a class="btn" href="{{url('product_details/'.$product['id'])}}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">

@if($discounted_price>0)
  <del>Rs.{{$product['product_price']}}</del> <span style="color: yellow;">Rs.{{$discounted_price}}</span>
@else
  Rs. {{$product['product_price']}}
@endif

</a></h4>

</div>
		</div>
					</li>
@endforeach 					
		</ul>
			</div>
@endsection
