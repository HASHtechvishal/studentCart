<?php //call that static function here
use App\Banner;

$get_banner = Banner::getBanner();//function in model
//echo "<pre>"; print_r($get_banner); die;

?>


@if(isset($page_name) && $page_name=="index")
<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
			@foreach($get_banner as $key =>$banner)
			<div class="item @if($key == 0)active @endif">
				<div class="container">
					<a @if(!empty($banner['link'])) href="{{url($banner['link'])}}" @else href="javascript:void(0)" @endif ><img style="width:100%" src="{{asset('e-com images/banner images/'.$banner['image'])}}" alt="{{$banner['alt']}}" title="{{$banner['title']}}" /></a>
					
				</div>
			</div>
			@endforeach
		</div>

	</div>
</div> 
@endif
{{--add key also to run one condition when key is is zero then it will active banner--}}