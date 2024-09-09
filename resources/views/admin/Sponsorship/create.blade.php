@extends('layouts.app')

@section('content')
	<div class="container">
		<h1>Sponsorizza</h1>

		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<form action="{{ route('sponsorship.store') }}" method="POST" id="payment-form">
			@csrf
			<label for="amount">Importo:</label>
			<input type="text" name="amount" id="amount" value="10.00">

			<div id="dropin-container"></div>

			<button type="submit" class="btn btn-primary">Paga</button>
		</form>
	</div>

	<script src="https://js.braintreegateway.com/web/dropin/1.28.0/js/dropin.min.js"></script>
	<script>
		var form = document.querySelector('#payment-form');
		var client_token = "{{ $token }}";

		braintree.dropin.create({
			authorization: client_token,
			selector: '#dropin-container'
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

					document.querySelector('input[name="payment_method_nonce"]').value = payload.nonce;
					form.submit();
				});
			});
		});
	</script>
@endsection
