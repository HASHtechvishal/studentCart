 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Stack Developers online Shopping cart</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<!-- Front style -->
	<link id="callCss" rel="stylesheet" href="{{url('css/e-com front css/front.min.css')}}" media="screen"/>
	<link href="{{url('css/e-com front css/base.css')}}" rel="stylesheet" media="screen"/>
	<!-- Front style responsive -->
	<link href="{{url('css/e-com front css/front-responsive.min.css')}}" rel="stylesheet"/>
	<link href="{{url('css/e-com front css/font-awesome.css')}}" rel="stylesheet" type="text/css">
	<!-- Google-code-prettify -->
	<link href="{{url('js/e-com js front/google-code-prettify/prettify.css')}}" rel="stylesheet"/>
	<!-- fav and touch icons -->
	<link rel="shortcut icon" href="{{asset('e-com images/front images/ico/favicon.ico')}}">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('e-com images/front images/ico/apple-touch-icon-144-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('e-com images/front images/ico/apple-touch-icon-114-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('e-com images/front images/ico/apple-touch-icon-72-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" href="{{asset('e-com images/front images/ico/apple-touch-icon-57-precomposed.png')}}">
	<style type="text/css" id="enject"></style>
	<style>
		form.cmxform label.error, label.error {
			color: red;
			font-style: italic
		}
	</style>
</head>
<body> 


@include('layouts.e-com front layout.front_header')

<!-- Header End====================================================================== --> 
@include('front e-com.banner.home_page_banner')



<div id="mainBody">
	<div class="container">
		<div class="row">
			<!-- Sidebar ================================================== -->
			
@include('layouts.e-com front layout.front_sidebar');

			<!-- Sidebar end=============================================== -->
			{{--main center  part--}}
			@yield('content')
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->

@include('layouts.e-com front layout.front_footer');

<!-- Placed at the end of the document so the pages load faster ============================================= -->
<script src="{{url('js/e-com js front/jquery.js')}}" type="text/javascript"></script> 
<script src="{{url('js/e-com js front/jquery.validate.js')}}" type="text/javascript"></script>
<script src="{{url('js/e-com js front/front.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/e-com js front/google-code-prettify/prettify.js')}}"></script>

<script src="{{url('js/e-com js front/front.js')}}"></script>
<script src="{{url('js/e-com js front/front_script.js')}}"></script>
<script src="{{url('js/e-com js front/jquery.lightbox-0.5.js')}}"></script>

</body>
</html>