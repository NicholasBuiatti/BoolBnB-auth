@extends('layouts.navBar')

@section('content')
	<div class="d-flex align-items-start col">

		<div class="d-flex flex-wrap">
			<div id="card-container" class="card col">
		
				<div class="card-body">
					<h2 class="card-title">{{ $message->name }}</h2>
					<p class="card-text">
					<p> email: {{ $message->email }}</p>
					<p> messaggio completo: {{ $message->text }}</p>
					<div class="text-center">
						<a class="btn btn-primary my-2" href="{{ route('apartments.index') }}">Indietro</a>
						<a class="btn btn-secondary" href="{{ route('apartments.edit', $message->id) }}">Modifica</a>

						{{-- BOTTONE CHE ATTIVA IL MODALE --}}
						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{ $message->id }}">
							Cancella
						</button>
						{{-- MODALE DI BOOTSTRAP --}}
						<div class="modal fade text-danger" id="modal-{{ $message->id }}" tabindex="-1" data-bs-backdrop="static"
							data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $message->id }}" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalTitle-{{ $message->id }}">
											Cancellazione
										</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<div class="modal-body">
										Stai cancellando il messaggio: {{ $message->title }}
										<br>Sicuro di proseguire??
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
											Close
										</button>

										<form action="{{ route('apartments.destroy', $message) }}" method="POST">
											@csrf
											@method('DELETE')
											<button class="btn btn-danger" type="submit">Elimina
											</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>
@endsection
