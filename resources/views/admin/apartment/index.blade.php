@extends('layouts.navBar')

@section('content')
	<table class="table table-hover">
		<thead>
			<tr>
				<th scope="col">Nome</th>
				<th scope="col">Stanze</th>
				<th scope="col">Bagni</th>
				<th scope="col">Letti</th>
				<th scope="col">Mq</th>
				<th scope="col">Dettagli/Modifica</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($catalogue as $apartment)
				<tr>
					<th scope="row">{{ $apartment->title }}</th>
					<td>{{ $apartment->rooms }}</td>
					<td>{{ $apartment->bathrooms }}</td>
					<td>{{ $apartment->beds }}</td>
					<td>{{ $apartment->dimension_mq }}</td>
					<td>
						<a class="btn btn-primary my-2" href="{{ route('apartments.show', $apartment->id) }}">D</a>
						<a class="btn btn-secondary" href="{{ route('apartments.edit', $apartment->id) }}">M</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{ $catalogue->links('pagination::bootstrap-5') }}
	@foreach($bin as $apartment)

	<div>{{$apartment->name}}</div>
	@endforeach
	{{-- <div class="d-flex align-items-start w-100">

		<div class="d-flex flex-wrap">
			@foreach ($catalogue as $apartment)
				<div id="card-container" class="card col-3">
					<div class="img-container">
						@if (Str::startsWith($apartment->image, 'http'))
							<img width="140" class="card-img-top" src="{{ $apartment->image }}" alt="">
						@else
							<img width="140" class="card-img-top" src="{{ asset('storage/' . $apartment->image) }}" alt="">
						@endif
					</div>
					<div class="card-body">
						<h2 class="card-title">{{ $apartment->title }}</h2>
						<p class="card-text">
						<p><i class="fa-solid fa-person-shelter"></i> Stanze: {{ $apartment->rooms }}</p>
						<p><i class="fa-solid fa-bed"></i> Letti: {{ $apartment->beds }}</p>
						<p><i class="fa-solid fa-bath"></i> Bagni: {{ $apartment->bathrooms }}</p>
						<p><i class="fa-solid fa-house"></i> Superficie: {{ $apartment->dimension_mq }}mq</p>
						</p>
						<div class="text-center">
							<a class="btn btn-primary my-2" href="{{ route('apartments.show', $apartment->id) }}">Dettagli</a>
							<a class="btn btn-secondary" href="{{ route('apartments.edit', $apartment->id) }}">Modifica</a>
						</div>

					</div>
				</div>
			@endforeach
		</div>
	</div> --}}
@endsection
