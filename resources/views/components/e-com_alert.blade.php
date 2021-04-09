
	@if(Session::has('login_error'))
	<div class="alert alert-danger alert-dismissible fade show text-capitalize" role="alert">
   {{Session::get('login_error')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger alert-dismissable fade show text-capitalize" role='alert'>
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>
</div>
@endif

	@if(Session::has('updated'))
	<div class="alert alert-success alert-dismissible fade show text-capitalize" role="alert">
   {{Session::get('updated')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
