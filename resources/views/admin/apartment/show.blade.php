@extends('layouts.navBar')

@section('content')
	<div class="d-flex align-items-start col">

		<div class="d-flex flex-wrap">
			<div id="card-container" class="card col">
				<div class="img-container">
					@if (Str::startsWith($apartment->image, 'http'))
						<img width="140" class="card-img-top" src="{{ $apartment->image }}" alt="">
					@else
						<img width="140" class="card-img-top" src="{{ asset('storage/' . $apartment->image) }}" alt="">
					@endif
				</div>
				<div class="card-body">
					<h2 class="card-title">{{ $apartment->title }}</h2>
					<p class="card-text">
					<p><i class="fa-solid fa-person-shelter"></i> Stanze: {{ $apartment->rooms }}</p>
					<p><i class="fa-solid fa-bed"></i> Letti: {{ $apartment->beds }}</p>
					<p><i class="fa-solid fa-bath"></i> Bagni: {{ $apartment->bathrooms }}</p>
					<p><i class="fa-solid fa-maximize"></i> Superficie: {{ $apartment->dimension_mq }}mq</p>
					<p><i class="fa-solid fa-house"></i> Indirizzo: {{ $apartment->address_full }}</p>
					<div class="text-center">
						<a class="btn btn-primary my-2" href="{{ route('apartments.index') }}">Indietro</a>
						<a class="btn btn-secondary" href="{{ route('apartments.edit', $apartment->id) }}">Modifica</a>

						{{-- BOTTONE CHE ATTIVA IL MODALE --}}
						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{ $apartment->id }}">
							Cancella
						</button>
						{{-- MODALE DI BOOTSTRAP --}}
						<div class="modal fade text-danger" id="modal-{{ $apartment->id }}" tabindex="-1" data-bs-backdrop="static"
							data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $apartment->id }}" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalTitle-{{ $apartment->id }}">
											Cancellazione
										</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<div class="modal-body">
										Stai cancellando l'appartamento: {{ $apartment->title }}
										<br>Sicuro di proseguire??
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
											Close
										</button>

										<form action="{{ route('apartments.destroy', $apartment) }}" method="POST">
											@csrf
											@method('DELETE')
											<button class="btn btn-danger" type="submit">Elimina
											</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<a href="{{ route('sponsorships.index', ['apartment' => $apartment->id]) }}" class="btn btn-primary">
							Sponsorizza questo appartamento
						</a>
					</div>

				</div>

			</div>
		</div>
	</div>
@endsection
