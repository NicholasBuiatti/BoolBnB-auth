@extends('layouts.navBar')

@section('content')
	<div class="rounded contenitore w-md-100">
		<h1 class="text-center">Messaggi ricevuti</h1>
		<table class="table table-responsive shadow-lg">
			<thead class="text-center">
				<tr class="d-none d-lg-table-row Myborder"
					style=" background: linear-gradient(130deg, #ebb7568a, #5fa2baa0) !important;">
					{{-- <th scope="col"></th> --}}
					<th scope="col" class="text-uppercase">Nome Appartamento</th>
					<th scope="col" class="text-uppercase">DATA</th>
					<th scope="col" class="text-uppercase">DA</th>
					<th scope="col" class="text-uppercase">DETTAGLI</th>
				</tr>
			</thead>
			<tbody class="">
				@foreach ($messages as $message)
					<tr class="text-center align-middle bordato MyborderBot"
						style=" background: linear-gradient(130deg, #d9b5738a, #5fa2baa0) !important;">

						{{-- <th scope="row" class="d-block d-md-table-cell col-12 col-lg-2">
							<img class="rounded shadow-sm" src="{{ $message->apartment->image }}" alt="Immagine appartamento"
								style="height: 8rem; width:15rem; object-fit: cover;">
						</th> --}}
						<td class=" d-block d-md-table-cell col-12 col-md-3">
							<h3 class="fs-4 myFont"><span class="sparisci">Appartamento:</span>{{ $message->apartment->title }}</h3>
						</td>
						<td class="d-block d-md-table-cell col-12 col-md-3">
							<h3 class="fs-6 myFont"><span class="sparisci">Ricevuto:</span>
								{{ $message->created_at }}</h3>
						</td>
						<td class="d-block d-md-table-cell col-12 col-md-3">
							<h3 class="fs-6 myFont"><span class="sparisci">Da:</span>
								{{ $message->email }}</h3>
						</td>
						<td class="d-block d-md-table-cell col-12 col-lg-3">
							<a class="visualizza btn btn-light border" href="{{ route('message.show', $message->id) }}"><span
									class="sparisci me-2">Dettagli</span><i class="fa-solid fa-magnifying-glass"></i></a>
							<!-- Bottone di cancellazione con modale -->
							<button type="button" class="visualizzaRed btn btn-danger border" data-bs-toggle="modal"
								data-bs-target="#modal-{{ $message->id }}">
								<i class="fa-solid fa-trash text-black"></i>
							</button>

							<!-- Modale per la cancellazione -->
							<div class="modal fade text-danger " id="modal-{{ $message->id }}" tabindex="-1" data-bs-backdrop="static"
								data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $message->id }}" aria-hidden="true">
								<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl " role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title fs-2 fw-bold" id="modalTitle-{{ $message->id }}">ATTENZIONE!!!!</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body fs-3">
											Stai cancellando il messaggio di: <span class="fw-bold">{{ $message->email }}</span> che fa riferimento a
											<span class="fw-bold">{{ $message->apartment->title }}</span><br>Sicuro di proseguire?
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
											<form action="{{ route('message.destroy', $message) }}" method="POST">
												@csrf
												@method('DELETE')
												<button class="btn btn-danger" type="submit">Elimina</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div class="altezza">
	{{ $messages->links('pagination::bootstrap-5') }}


	<style>
		.Myborder {
			border: 2px solid #a9a9a9;
		}

		.MyborderBot {
			border-bottom: 2px solid #bfbfbf;
		}

		.myFont {
			font-family: 'Roboto', sans-serif;
			color: #333333;
			/* Grigio scuro */
		}

		td,
		th {
			background-color: rgba(235, 245, 246, 0.74) !important;
		}

		.visualizzaRed,
		.visualizza {
			background-color: #cbe5eb;
		}

		.visualizza:hover {
			background-color: #8cdbed;
		}


		.visualizzaRed:hover {
			background-color: #d62839;
		}

		.modifica {
			background-color: #cfa165;
			width: 9rem;
		}

		.altezza {
			height: 3.2rem;
		}

		.sparisci {
			display: none
		}

		@media screen and (min-width:768px) {
			.w-md-100 {
				width: 100% !important;
			}
		}

		@media screen and (max-width:990px) {
			.w-md-100 {
				margin-top: 7rem !important;
			}
		}

		@media screen and (max-width:768px) {
			.w-md-100 {
				margin-top: 6rem !important;
			}

			.bordato {
				border: 2px solid #a9a9a9;
				/* border: 3px solid #bfbfbf; */
				/* border: 3px solid #bababa; */
			}

			th {
				border: none !important;
			}

			td {
				border: none !important;
			}

			.sparisci {
				display: unset;
			}
		}
	</style>
@endsection
