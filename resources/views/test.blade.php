<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Test</title>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
	<div class="container" id="app">
		<example-component :data="{{ json_encode($data) }}"></example-component>
		{{-- <echo-component></echo-component> --}}
	</div>

	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>