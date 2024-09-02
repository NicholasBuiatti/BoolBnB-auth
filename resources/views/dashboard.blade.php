@extends('layouts.navBar')

@section('content')
	<div class="d-flex gap-5">
		{{-- <div id="right-dashboard" class="col-2">

			<h1>Dashboard</h1>
			<ul>
				<li><a href="{{ route('apartments.index') }}">Elenco Appartamenti</a></li>
				<li><a href="{{ route('apartments.create') }}">Inserisci nuovo appartamento</a></li>
				<li><a href="">Messaggi ricevuti</a></li>
				<li><a href="">Storico acquisti</a></li>
			</ul>
		</div> --}}
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
				</div>
			</div>
		</div>
	</div>
@endsection
