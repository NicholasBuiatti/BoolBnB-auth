@extends('layouts.navBar')

@section('content')
	@foreach ($bin as $apartment)
		<div class="card text-center mt-2">
			<div class="card-body d-flex flex-column flex-md-row align-items-center">
				<div class="d-flex flex-column flex-sm-row col-12 col-md-7 align-items-center justify-content-between">
					<div>
						<img src="{{ $apartment->image }}" class="rounded" alt=""
							style="height: 8rem; width:15rem; object-fit: cover;">
					</div>
					<div class="col-5">
						<h5 class="card-title fs-3" style="color: #6f5a4a">{{ $apartment->title }}</h5>
						<p class="card-text">{{ $apartment->address_full }}</p>
					</div>
				</div>
				<div class="row col-12 col-md-5 align-items-center mt-3 mt-md-0">
					<div class="d-flex flex-column col-6 align-items-center">
						<p class="mb-2"><span class="fw-bold">Camere: </span>{{ $apartment->rooms }}</p>
						<p class="mb-2"><span class="fw-bold">Bagni: </span>{{ $apartment->bathrooms }}</p>
						<p class="mb-2"><span class="fw-bold">Letti: </span>{{ $apartment->beds }}</p>
						<p class="mb-2"><span class="fw-bold">Dimensioni: </span>{{ $apartment->dimension_mq }} mq</p>
					</div>
					<div class="col-6 overflow-auto" style="height: 8rem">
						<ul class="mb-0 list-unstyled">
							@foreach ($apartment->services as $service)
								<li>
									- {{ $service->name }}
								</li>
							@endforeach

						</ul>
					</div>
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
