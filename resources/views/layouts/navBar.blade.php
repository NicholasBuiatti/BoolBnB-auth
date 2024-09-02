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

	<!-- Usando Vite -->
	@vite(['resources/js/app.js'])
</head>


<body>
	<div id="app">
		<div class="container-fluid vh-100">
			<div class="row h-100">
				<nav class="col-md-3 col-lg-2 d-flex flex-column flex-shrink-0 p-3 text-white bg-dark navbar-dark sidebar">
					<a class="d-none d-md-block navbar-brand d-flex align-items-center" href="{{ url('/') }}">
						<div class="logo_laravel">
							<img src="{{ asset('logo.png') }}" class="img-fluid" alt="">
						</div>
					</a>
					<hr class="d-none d-md-block">
					<ul class="nav nav-pills flex-md-column justify-content-between mb-auto">
						<li class="nav-item">
							<a href="{{ route('dashboard') }}"
								class="nav-link text-white {{ Route::currentRouteName() == 'dashboard' ? 'bg-secondary' : '' }}"
								aria-current="page">
								Home
							</a>
						</li>
						<li>
							<a href="{{ route('apartments.index') }}"
								class="nav-link text-white {{ Route::currentRouteName() == 'apartments.index' ? 'bg-secondary' : '' }}"
								aria-current="page">
								I miei appartamenti
							</a>
						</li>
						<li>
							<a href="{{ route('apartments.create') }}"
								class="nav-link text-white {{ Route::currentRouteName() == 'apartments.create' ? 'bg-secondary' : '' }}"
								aria-current="page">
								Aggiungi un appartamento
							</a>
						</li>
						<li>
							<a href="#" class="nav-link text-white">
								Statistiche
							</a>
						</li>
						<li>
							<a href="#" class="nav-link text-white">
								Messaggi
							</a>
						</li>
					</ul>
					<hr>
					<div class="dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false" v-pre>
							{{ Auth::user()->email }}
						</a>
						<ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
							<li><a class="dropdown-item" href="{{ url('/') }}">{{ __('Home') }}</a></li>
							<li><a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="{{ route('logout') }}"
									onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a></li>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</ul>
					</div>
				</nav>
				<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 overflow-auto">
					@yield('content')
				</main>
			</div>
		</div>
	</div>
</body>

</html>
