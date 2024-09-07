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
			@foreach ($bin  as $apartment)
				<tr>
					<th scope="row">{{ $apartment->title }}</th>
					<td>{{ $apartment->rooms }}</td>
					<td>{{ $apartment->bathrooms }}</td>
					<td>{{ $apartment->beds }}</td>
					<td>{{ $apartment->dimension_mq }}</td>
					<td>
                        <a href="{{ route('apartments.restore', $apartment->id) }}">Restore</a>
						<a class="btn btn-secondary" href="{{ route('apartments.index') }}">M</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{-- {{ $bin->links('pagination::bootstrap-5') }} --}}

@endsection
