<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
	@yield('title',config('site.web_name'))
	</title>
	@yield('meta')
	<link rel="stylesheet" href="{{static_asset('vendor/bootstrap/css/bootstrap.min.css')}}" />
	<link rel="stylesheet" href="{{static_asset('vendor/common/css/global.css')}}" />
	<link rel="stylesheet" href="{{static_asset('vendor/common/css/bootstrap.custom.css')}}" />
	@yield('style')
</head>
<body>
	@yield('body')
	@section('script')
		<script src="{{static_asset('vendor/common/js/jquery-2.1.3.min.js')}}"></script>
		<script src="{{static_asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="{{static_asset('vendor/common/js/common.js')}}"></script>
		<script>
			$.ajaxSetup({
		  	    headers: {
		  	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  	    }
		  	});
		</script>
	@show
</body>
</html>