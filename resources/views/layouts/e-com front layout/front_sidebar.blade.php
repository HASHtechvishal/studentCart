   <?php
use App\Section;
$sections = Section::section();
//echo "<pre>"; print_r($section); die;
?>
  <div id="sidebar" class="span3">
	<div class="well well-small"><a id="myCart" href="{{url('cart')}}"><img src="{{asset('e-com images/front images/ico-cart.png')}}" alt="cart"><span class="totalCartItems">{{totalCartItems()}}</span> Items in your cart</a></div>
	<ul id="sideManu" class="nav nav-tabs nav-stacked">
@foreach($sections as $section)
@if(count($section['categories'])>0)		
	<li class="subMenu"><a>{{$section['name']}}</a>
@foreach($section['categories'] as $category)		
	<ul>
	<li><a href="{{$category['url']}}"><i class="icon-chevron-right"></i><strong>{{$category['category_name']}}</strong></a></li>
@foreach($category['sub_categories'] as $sub)	
	<li><a href="{{$sub['url']}}"><i class="icon-chevron-right"></i>{{$sub['category_name']}}</a></li>
@endforeach	
	</ul>
@endforeach	
   </li>
 @endif  
 @endforeach    
</ul>  <br>
@if(isset($page_name) && $page_name=="listing")
 <div class="well well-small">
 	<h5>fabric</h5>
 	@foreach($fabric_array as $fabric)
 	<input class="fabric" type="checkbox" name="fabric[]" id="{{$fabric}}" value="{{$fabric}}">&nbsp;&nbsp;{{$fabric}} <br> 
 	@endforeach
 </div>

 <div class="well well-small">
 	<h5>sleeve</h5>
 	@foreach($sleeve_array as $sleeve)
 	<input class="sleeve" type="checkbox" name="sleeve[]" id="{{$fabric}}" value="{{$sleeve}}">&nbsp;&nbsp;{{$sleeve}} <br> 
 	@endforeach
 </div>

 <div class="well well-small">
 	<h5>pattern</h5>
 	@foreach($pattern_array as $pattern)
 	<input class="pattern" type="checkbox" name="pattern[]" id="{{$pattern}}" value="{{$pattern}}">&nbsp;&nbsp;{{$pattern}} <br> 
 	@endforeach
 </div>

 <div class="well well-small">
 	<h5>fit</h5>
 	@foreach($fit_array as $fit)
 	<input class="fit" type="checkbox" name="fit[]" id="{{$fit}}" value="{{$fit}}">&nbsp;&nbsp;{{$fit}} <br> 
 	@endforeach
 </div>

 <div class="well well-small">
 	<h5>occassion</h5>
 	@foreach($occassion_array as $occassion)
 	<input class="occassion" type="checkbox" name="occassion[]" id="{{$occassion}}" value="{{$occassion}}">&nbsp;&nbsp;{{$occassion}} <br> 
 	@endforeach
 </div>
@endif
<br/>
<div class="thumbnail">
<img src="{{asset('e-com images/front images/payment_methods.png')}}" title="Payment Methods" alt="Payments Methods">
<div class="caption">
<h5>Payment Methods</h5>
</div>
</div>
</div>
