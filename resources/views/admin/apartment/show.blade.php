@extends('layouts.navBar')

@section('content')
	<div class="container mt-5">
		<div class="row justify-content-between align-items-start">
			<!-- Colonna immagine -->
			<div class="row col-12 mb-4">
				<div class="col-6">
					@if (Str::startsWith($apartment->image, 'http'))
						<img class="img-fluid rounded object-fit-cover" src="{{ $apartment->image }}" alt="{{ $apartment->title }}">
					@else
						<img class="img-fluid rounded object-fit-cover" src="{{ asset('storage/' . $apartment->image) }}"
							alt="{{ $apartment->title }}">
					@endif
				</div>

				<!-- Dettagli appartamento sotto l'immagine -->
				<div class="mt-3 col-6">
					<h2 class="card-title mb-3">{{ $apartment->title }}</h2>
					<p><i class="fa-solid fa-house"></i> Indirizzo: {{ $apartment->address_full }}</p>
					@if ($lastSponsorship)
						<p><i class="fa-solid fa-eye">Fine Sponsorizzazione: {{ $lastSponsorship->pivot->ending_date }}</p>
					@else
						<p><i class="fa-solid fa-eye-slash"></i> Non Sponsorizzato</p>
					@endif

				</div>
			</div>
			<hr>
			<!-- Colonna informazioni principali e servizi -->
			<div class="row col-12">
				<div class="col-6">
					<p><i class="fa-solid fa-person-shelter"></i> Stanze: {{ $apartment->rooms }}</p>
					<p><i class="fa-solid fa-bed"></i> Letti: {{ $apartment->beds }}</p>
					<p><i class="fa-solid fa-bath"></i> Bagni: {{ $apartment->bathrooms }}</p>
					<p><i class="fa-solid fa-maximize"></i> Superficie: {{ $apartment->dimension_mq }}mq</p>

				</div>

				<!-- Servizi -->
				<div class="col-6">
					<h5>Servizi:</h5>
					<ul class="list-unstyled d-flex flex-wrap">
						@foreach ($apartment->services as $service)
							<li class="me-3"><i class="fa-solid fa-check"></i> {{ $service->name }}</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>

		<!-- Bottoni di azione -->
		<div class="mt-5 d-flex justify-content-between">
			<a class="btn btn-primary" href="{{ route('apartments.index') }}"><i class="fa-solid fa-arrow-left"></i></a>
			<div>
				<a class="btn btn-secondary me-2" href="{{ route('apartments.edit', $apartment->id) }}"><i
						class="fa-solid fa-pen"></i></a>
				<!-- Bottone di cancellazione con modale -->
				<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{ $apartment->id }}">
					<i class="fa-solid fa-trash"></i>
				</button>

				<!-- Modale per la cancellazione -->
				<div class="modal fade text-danger" id="modal-{{ $apartment->id }}" tabindex="-1" data-bs-backdrop="static"
					data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $apartment->id }}" aria-hidden="true">
					<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalTitle-{{ $apartment->id }}">Cancellazione</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								Stai cancellando l'appartamento: {{ $apartment->title }}<br>Sicuro di proseguire?
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
								<form action="{{ route('apartments.destroy', $apartment) }}" method="POST">
									@csrf
									@method('DELETE')
									<button class="btn btn-danger" type="submit">Elimina</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
