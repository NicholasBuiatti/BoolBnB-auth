@extends('layouts.navBar')

@section('content')
	<table class="table table-hover table-responsive">
		<thead class="">
			<tr class="table-dark text-center">
				<th scope="col"></th>
				<th scope="col">Nome</th>
				<th scope="col">Data di fine Sponsorizzazione</th>
				<th scope="col">Visibile</th>
				<th scope="col">Dettagli/Modifica</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($catalogue as $apartment)
				<tr class="align-middle text-center">
					<th scope="row">
						<img class="object-fit" src="{{ $apartment->image }}" alt="" style="height: 10rem; width:12rem">
					</th>
					<td class="fs-2 fw-bolder">{{ $apartment->title }}</td>
					<td>
						@if ($apartment->sponsorships->isNotEmpty())
							@foreach ($apartment->sponsorships as $sponsorship)
								<p>{{ $sponsorship->pivot->ending_date }}</p>
							@endforeach
						@else
							<p class="mb-0">Non Sponsorizzato</p>
						@endif
					</td>
					<td>
						@if ($apartment->is_visible == 1)
							<i class="fa-solid fa-check fs-3 text-success"></i>
						@else
							<i class="fa-solid fa-xmark text-danger"></i>
						@endif
					</td>
					<td>
						<a class="btn btn-primary my-2" href="{{ route('apartments.show', $apartment->id) }}"><i
								class="fa-solid fa-eye"></i></a>
						<a class="btn btn-secondary" href="{{ route('apartments.edit', $apartment->id) }}"><i
								class="fa-solid fa-pen"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{ $catalogue->links('pagination::bootstrap-5') }}
@endsection
