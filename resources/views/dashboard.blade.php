@extends('layouts.navBar')

@section('content')
	<div class="d-flex gap-5">

		<div class="col">
			<h2 class="fs-4 text-secondary my-4">
				{{ __('Dashboard') }}
			</h2>
			<div class="row justify-content-center">
				<div class="col">
					<div class="card">
						<div class="card-header">{{ __('Dashboard utente') }}</div>

						<div class="card-body">
							@if (session('status'))
								<div class="alert alert-success" role="alert">
									{{ session('status') }}
								</div>
							@endif

							{{ __('Login eseguito con successo!') }}
						</div>



					</div>
					<section class="container mt-4">
						<div class="row justify-content-between">

							<div class="card col-6">
								<div class="card-header">
									I miei Appartamenti
								</div>
								<div class="card-body">
									<h5 class="card-title">Posseduti: {{ $catalogue->total() }} ecco i primi {{ count($catalogue) }}</h5>
									<ul>
										@foreach ($catalogue as $apartment)
											<li>{{ $apartment->title }}</li>
										@endforeach
									</ul>
									<a href="{{ route('apartments.index') }}" class="btn btn-primary">{{ __('Vai alla lista dettagliata') }}</a>
								</div>
							</div>
							<div class="card col-5">
								<div class="card-header">
									Messaggi
								</div>
								<div class="card-body">
									{{-- <h5 class="card-title">Posseduti: {{ $catalogue->total() }} ecco i primi {{ count($catalogue) }}</h5>
									<ul>
										@foreach ($catalogue as $apartment)
											<li>{{ $apartment->title }}</li>
										@endforeach
									</ul> --}}
									<a href="#" class="btn btn-primary">Go somewhere</a>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
@endsection
