@if((boolean)$_msg = session('app_message'))
	@if(count($errors)>0)
		<div class="alert alert-danger">{{$_msg}} ({{session('app_code')}})</div>
	@else
		<div class="alert alert-success">{{$_msg}} ({{session('app_code')}})</div>
	@endif
@endif
