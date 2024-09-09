@extends('layouts.app')

@section('content')
	<h1>Seleziona una Sponsorizzazione</h1>

	<form id="payment-form" method="POST" action="{{ route('sponsorships.payment') }}">
		@csrf

		<label for="sponsorship">Scegli la tua sponsorizzazione:</label>
		<select name="amount" id="sponsorship">
			@foreach ($sponsorships as $sponsorship)
				<option value="{{ $sponsorship['price'] }}">{{ $sponsorship['name'] }} - ${{ $sponsorship['price'] }}</option>
			@endforeach
		</select>

		<div id="dropin-container"></div>

		<button type="submit">Paga ora</button>
	</form>

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
