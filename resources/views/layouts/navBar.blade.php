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
		<div class="container-fluid vh-100" style="background: linear-gradient(130deg, #fff6e7, #a8c2cb);">
			<div class="row h-100 d-md-flex">
				<nav class="d-md-none navbar navbar-expand-lg">
					<div class="container-fluid">
						<a class="col-3 navbar-brand d-flex align-items-center" href="{{ url('/') }}">
							<div class="logo_laravel">
								<img src="{{ asset('logo.png') }}" class="img-fluid" alt="">
							</div>
						</a>
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
							aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarNav">
							<ul class="nav nav-pills flex-column justify-content-between mb-auto" style="height: 50vh">
								<li class="nav-item d-inline">
									<a href="{{ route('dashboard') }}"
										class="nav-link text-dark {{ Route::currentRouteName() == 'dashboard' ? 'd-none' : '' }}" aria-current="page">
										Home
									</a>
								</li>
								<li>
									<a href="{{ route('apartments.index') }}"
										class="nav-link text-dark {{ Route::currentRouteName() == 'apartments.index' ? 'd-none' : '' }}"
										aria-current="page">
										I miei appartamenti
									</a>
								</li>
								<li>
									<a href="{{ route('apartments.create') }}"
										class="nav-link text-dark {{ Route::currentRouteName() == 'apartments.create' ? 'd-none' : '' }}"
										aria-current="page">
										Aggiungi un appartamento
									</a>
								</li>
								<li>
									<a href="{{ route('apartments.bin') }}"
										class="nav-link text-dark {{ Route::currentRouteName() == 'apartments.bin' ? 'd-none' : '' }}"
										aria-current="page">
										Appartamenti eliminati
									</a>
								</li>

								{{-- <li>
									<a href="#" class="nav-link text-white">
										Statistiche
									</a>
								</li> --}}
								<li>
									<a href="{{ route('message.index') }}"
										class="nav-link text-dark {{ Route::currentRouteName() == 'message.index' ? 'd-none' : '' }}"
										aria-current="page">
										Messaggi
									</a>
								</li>
								<hr>
								<li class="dropdown">
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
								</li>
							</ul>
						</div>
					</div>
				</nav>



				<nav
					class="text-center d-none col-md-3 col-lg-2 d-md-flex flex-column flex-shrink-0 p-3 text-white navbar-dark sidebar h-100 border border-2 border-end">
					<a class="d-none d-md-block navbar-brand
					d-flex align-items-center" href="{{ url('/') }}">
						<div class="logo_laravel">
							<img src="{{ asset('logo.png') }}" class="img-fluid" alt="">
						</div>
					</a>
					<hr class="d-none d-md-block">
					<ul class="nav nav-pills flex-md-column justify-content-between mb-auto">
						<li class="nav-item">
							<a href="{{ route('dashboard') }}"
								class="nav-link text-dark {{ Route::currentRouteName() == 'dashboard' ? 'fw-bold text-decoration-underline' : '' }}"
								aria-current="page">
								Home
							</a>
						</li>
						<li>
							<a href="{{ route('apartments.index') }}"
								class="nav-link text-dark {{ Route::currentRouteName() == 'apartments.index' ? 'fw-bold text-decoration-underline' : '' }}"
								aria-current="page">
								I miei appartamenti
							</a>
						</li>
						<li>
							<a href="{{ route('apartments.create') }}"
								class="nav-link text-dark {{ Route::currentRouteName() == 'apartments.create' ? 'fw-bold text-decoration-underline' : '' }}"
								aria-current="page">
								Aggiungi un appartamento
							</a>
						</li>
						<li>
							<a href="{{ route('apartments.bin') }}"
								class="nav-link text-dark {{ Route::currentRouteName() == 'apartments.bin' ? 'fw-bold text-decoration-underline' : '' }}"
								aria-current="page">
								Appartamenti eliminati
							</a>
						</li>

					
						<li>
							<a href="{{ route('message.index') }}"
								class="nav-link text-dark {{ Route::currentRouteName() == 'message.index' ? 'fw-bold text-decoration-underline' : '' }}"
								aria-current="page">
								Messaggi
							</a>
						</li>
					</ul>
					<hr>
					<div class="dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button"
							data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
				<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 overflow-auto h-100 p-3">
					@yield('content')
				</main>
			</div>
		</div>
	</div>
</body>

</html>
