<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

	</head>
	<body>
		@include("layouts.partials.navbar")
		@yield('banner')
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="h2">@yield('page-title')</div>
				</div>
			</div>
			<div class="row">
				{{-- <div class="col-md-3"> --}}
					@yield('extraInfo')
				{{-- </div> --}}
				{{-- <div class="col-md-9"> --}}
					@yield('content')
				{{-- </div> --}}
			</div>
		</div>
		<script
		src="http://code.jquery.com/jquery-3.3.1.js"
		integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
		crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		{{-- <script src="{{ asset('js/popper.min.js') }}"></script> --}}
		<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=cwom5ca4igirexlgjx35h09rg0x2v7iigh2an6ggydkm3kb8"></script>
		<script src="{{ asset('/js/main.js') }}"></script>
		@yield('js')
	</body>
</html>
