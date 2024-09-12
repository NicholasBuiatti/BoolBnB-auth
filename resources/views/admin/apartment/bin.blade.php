@extends('layouts.navBar')

@section('content')
	<table class="table table-striped table-responsive shadow-lg rounded"
		style="background-color: #f5f7fa; border-collapse: separate; border-spacing: 0 1rem; max-width: 1400px;">
		<thead class="text-center" style="background-color: #34495e; color: #ecf0f1; border-radius: 8px;">
			<tr class="d-none d-md-table-row">
				<th scope="col"></th>
				<th scope="col">Nome</th>
				<th scope="col">Data di cancellazione</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($bin as $apartment)
				<tr class="text-center align-middle" style="background-color: #ffffff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">

					<th scope="row" class="d-block d-sm-table-cell col-12 col-md-2">
						<img class="rounded shadow-sm" src="{{ $apartment->image }}" alt="Immagine appartamento"
							style="height: 8rem; width:15rem; object-fit: cover;">
					</th>
					<td class="d-block d-sm-table-cell col-12 col-md-3">
						<h3 class="fs-4 title-shadow">{{ $apartment->title }}</h3>
					</td>
					<td class="d-block d-sm-table-cell col-12 col-md-3">
						<h3 class="fs-4 title-shadow">{{ $apartment->deleted_at }}</h3>
					</td>


				</tr>
			@endforeach
		</tbody>
	</table>
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
