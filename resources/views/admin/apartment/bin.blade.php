@extends('layouts.navBar')

@section('content')
	@foreach ($bin as $apartment)
		<div class="card text-center">
			<div class="card-header">
				Featured
			</div>
			<div class="card-body row">
				<div class="col-3">
					<img src="{{ $apartment->image }}" alt="" style="height: 8rem; width:15rem; object-fit: cover;">
				</div>
				<div class="col-9">
					<h5 class="card-title">Special title treatment</h5>
					<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
					<a href="#" class="btn btn-primary">Go somewhere</a>
				</div>

			</div>
			<div class="card-footer text-muted">
				Data di canellazione: {{ $apartment->deleted_at }}
			</div>
		</div>
	@endforeach

	{{-- {{ $bin->links('pagination::bootstrap-5') }} --}}

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
