<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	{{-- Font-Awesome --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
		integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />


	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link rel="icon" href= "{{ asset('logofull.png') }}">
	<!-- Usando Vite -->
	@vite(['resources/js/app.js'])
</head>

<body>
	<div id="app" class="vh-100 overflow-auto" style="background: linear-gradient(130deg, #fff6e7, #a8c2cb);">


		<nav class=" width-100 px-5 d-flex justify-content-center align-items-center">
		<a class="navbar-brand  d-flex align-items-center" href="{{ url('/') }}">
			<div class="logo_laravel">
				<img height="70px" src="{{ asset('logo.png') }}" alt="">
			</div>
		</a>
		</nav>

		<main class="">
			@yield('content')
		</main>
	</div>
</body>

</html>
