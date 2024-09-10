@extends('layouts.navBar')

@section('content')
	<div class="d-flex align-items-start col">

		<div class="d-flex flex-wrap">
			<div id="card-container" class="card col">
				<div class="row justify-content-between">
					<div class="col" style='heigth: 75vh'>
						@if (Str::startsWith($apartment->image, 'http'))
							<img width="140" class="container-fluid" src="{{ $apartment->image }}" alt="">
						@else
							<img width="140" class="object-fit-contain" src="{{ asset('storage/' . $apartment->image) }}" alt="">
						@endif
					</div>
					<div class="col-7">
						<h2 class="card-title">{{ $apartment->title }}</h2>
						<p><i class="fa-solid fa-house"></i> Indirizzo: {{ $apartment->address_full }}</p>
						@if ($apartment->sponsorships->isNotEmpty())
							@foreach ($apartment->sponsorships as $sponsorship)
								<p>Inizio Sponsorizzazione:{{ $sponsorship->pivot->ending_date }}</p>
								<p>Fine Sponsorizzazione:{{ $sponsorship->pivot->ending_date }}</p>
							@endforeach
						@else
							<p>Non Sponsorizzato</p>
						@endif
						<p><i class="fa-solid fa-person-shelter"></i> Stanze: {{ $apartment->rooms }}</p>
						<p><i class="fa-solid fa-bed"></i> Letti: {{ $apartment->beds }}</p>
						<p><i class="fa-solid fa-bath"></i> Bagni: {{ $apartment->bathrooms }}</p>
						<p><i class="fa-solid fa-maximize"></i> Superficie: {{ $apartment->dimension_mq }}mq</p>
						<p>Servizi:</p>
						<ul>
							@foreach ($apartment->services as $service)
								<li>{{ $service->name }}</li>
							@endforeach
						</ul>
						<div class="text-center">
							<a class="btn btn-primary my-2" href="{{ route('apartments.index') }}">Indietro</a>
							<a class="btn btn-secondary" href="{{ route('apartments.edit', $apartment->id) }}">Modifica</a>

							{{-- BOTTONE CHE ATTIVA IL MODALE --}}
							<button type="button" class="btn btn-danger" data-bs-toggle="modal"
								data-bs-target="#modal-{{ $apartment->id }}">
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

							<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
								aria-controls="offcanvasRight">Sponsorizza</button>

							<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
								<div class="offcanvas-header">
									<h5 id="offcanvasRightLabel">Seleziona ed effettua il pagamento</h5>
									<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
								</div>
								<div class="offcanvas-body">
									<h1>Seleziona una Sponsorizzazione</h1>

									<form id="payment-form" method="POST"
										action="{{ route('sponsorships.payment', ['apartment' => $apartment->id]) }}">
										<!-- Solo apartment->id -->
										@csrf

										<label for="sponsorship">Scegli la tua sponsorizzazione:</label>
										<select name="sponsorship_id" id="sponsorship">
											@foreach ($sponsorships as $sponsorship)
												<option value="{{ $sponsorship->id }}" data-amount="{{ $sponsorship->price }}">
													{{ $sponsorship->name }} - ${{ $sponsorship->price }}
												</option>
											@endforeach
										</select>


										<div id="dropin-container"></div>

										<button type="submit">Paga ora</button>
									</form>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>
	<script>
		var form = document.querySelector('#payment-form');
		var clientToken = "{{ $clientToken }}";

		braintree.dropin.create({
			authorization: clientToken,
			container: '#dropin-container'
		}, function(createErr, instance) {
			form.addEventListener('submit', function(event) {
				event.preventDefault();

				instance.requestPaymentMethod(function(err, payload) {
					if (err) {
						console.error(err);
						return;
					}

					// Aggiungi il nonce nel form e invia
					var nonceInput = document.createElement('input');
					nonceInput.setAttribute('type', 'hidden');
					nonceInput.setAttribute('name', 'payment_method_nonce');
					nonceInput.setAttribute('value', payload.nonce);
					form.appendChild(nonceInput);

					form.submit();
				});
			});
		});
	</script>
@endsection
