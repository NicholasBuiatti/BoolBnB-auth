@extends('layouts.navBar')

@section('content')
	<table class="table table-striped table-responsive shadow-lg rounded"
		style="background-color: #f5f7fa; border-collapse: separate; border-spacing: 0 1rem; max-width: 1400px;">
		<thead class="text-center" style="background-color: #34495e; color: #ecf0f1; border-radius: 8px;">
			<tr class="d-none d-md-table-row">
				<th scope="col"></th>
				<th scope="col" class="text-uppercase">Nome</th>
				<th scope="col" class="text-uppercase">Sponsorizzazione</th>
				<th scope="col" class="text-uppercase">Visibile</th>
				<th scope="col" class="text-uppercase">Azioni</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($catalogue as $apartment)
				<tr class="text-center align-middle" style="background-color: #ffffff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">

					<th scope="row" class="d-block d-sm-table-cell col-12 col-md-2">
						<img class="rounded shadow-sm" src="{{ $apartment->image }}" alt="Immagine appartamento"
							style="height: 8rem; width:15rem; object-fit: cover;">
					</th>
					<td class="d-block d-sm-table-cell col-12 col-md-3">
						<h3 class="fs-4 title-shadow">{{ $apartment->title }}</h3>
					</td>


					<td class="d-block d-sm-table-cell col-12 col-md-3">
						@if ($apartment->lastSponsorship)
							<p class="fw-light">Fine della Sponsorizzazione: <br> {{ $apartment->lastSponsorship->pivot->ending_date }}</p>
						@endif
						<button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas"
							data-bs-target="#offcanvasRight-{{ $apartment->id }}" aria-controls="offcanvasRight">
							<i class="fa-solid fa-bullhorn"></i> Sponsorizza
						</button>

						<div class="offcanvas w-100 offcanvas-end"
							style="background: linear-gradient(130deg, #fff6e7, #a8c2cb); tabindex="-1"
							id="offcanvasRight-{{ $apartment->id }}" aria-labelledby="offcanvasRightLabel-{{ $apartment->id }}">
							<div class="offcanvas-header">
								<h1 class="mx-auto">Seleziona una Sponsorizzazione</h1>
								<button type="button" class="btn-close text-reset ms-0" data-bs-dismiss="offcanvas" aria-label="Close"></button>
							</div>
							<div class="offcanvas-body">
								<div class="container">


									<form id="payment-form-{{ $apartment->id }}" method="POST"
										action="{{ route('sponsorships.payment', ['apartment' => $apartment->id]) }}">
										@csrf
										<div class="row justify-content-around">
											@foreach ($sponsorships as $sponsorship)
												<div class="card border-info mb-3 col-10 col-lg-3 shadow p-3 mb-5 bg-body rounded"
													style="{{ $sponsorship->name == 'Basic' ? 'background: linear-gradient(130deg, #f8ebd1, #b89a6e);' : '' }}
													{{ $sponsorship->name == 'Premium' ? 'background: linear-gradient(130deg, #f0f4f8, #c0c0c0);' : '' }}
													 {{ $sponsorship->name == 'Elite'
													    ? 'background: linear-gradient(130deg, #fff5e4, #f2c27f);
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																															'
													    : '' }}">
													<div class="card-header text-uppercase fs-3 fw-bold">{{ $sponsorship->name }}</div>
													<div class="card-body">
														<p>{{ $sponsorship->description }}</p>
														<input type="radio" name="sponsorship_id" id="sponsorship_{{ $sponsorship->id }}"
															value="{{ $sponsorship->id }}" data-amount="{{ $sponsorship->price }}">
														<label for="sponsorship_{{ $sponsorship->id }}">
															{{ $sponsorship->name }} - €{{ $sponsorship->price }}
														</label>
													</div>
												</div>
											@endforeach

										</div>
										<div id="dropin-container-{{ $apartment->id }}" class="col-10 col-lg-4 mx-auto shadow p-3 mb-5 rounded"></div>

										<button type="submit" class="btn btn-custom">Paga ora</button>
									</form>

								</div>
							</div>
						</div>
					</td>
					<td class="d-block d-sm-table-cell col-12 col-md-3">
						@if ($apartment->is_visible == 1)
							<i class="fa-solid fa-eye fs-3 "></i>
						@else
							<i class="fa-solid fa-eye-slash fs-3"></i>
						@endif
					</td>
					<td class="d-block d-sm-table-cell col-12 col-md-3">
						<a class="btn btn-light border my-1" href="{{ route('apartments.show', $apartment->id) }}"
							style="background-color: #ecf0f1;">
							<i class="fa-solid fa-eye"></i> Visualizza
						</a>
						<a class="btn btn-warning text-dark my-1" href="{{ route('apartments.edit', $apartment->id) }}">
							<i class="fa-solid fa-pen"></i> Modifica
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{{ $catalogue->links('pagination::bootstrap-5') }}

	<script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>
	<script>
		document.querySelectorAll('button[data-bs-toggle="offcanvas"]').forEach(function(button) {
			button.addEventListener('click', function() {
				// Recupera l'id dell'appartamento dal data-bs-target
				var apartmentId = this.getAttribute('data-bs-target').split('-').pop();

				// Seleziona il form e il dropin-container per l'appartamento specifico
				var form = document.querySelector('#payment-form-' + apartmentId);
				var dropinContainer = document.querySelector('#dropin-container-' + apartmentId);

				// Inizializza Braintree Drop-in per questo specifico appartamento
				braintree.dropin.create({
					authorization: "{{ $clientToken }}",
					container: dropinContainer,
					locale: 'it' // Imposta la lingua italiana
				}, function(createErr, instance) {
					if (createErr) {
						console.error(createErr);
						return;
					}

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
			});
		});
	</script>

	<style>
		.title-shadow {
			text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
			/* Direzione e ombra */
		}

		/* CSS PER PULSANTE CUSTOM */

		.btn-custom {
			background: linear-gradient(130deg, #f7c6c7, #f9e1d1);
			border: none;
			color: #333;
			font-weight: bold;
			border-radius: 30px;
			padding: 10px 20px;
			transition: background 0.3s, transform 0.3s;
		}

		.btn-custom:hover {
			background: linear-gradient(130deg, #f4a4a5, #f7d0c5);
			transform: scale(1.05);
		}

		.btn-custom:focus,
		.btn-custom:active {
			box-shadow: none;
		}
	</style>
@endsection
