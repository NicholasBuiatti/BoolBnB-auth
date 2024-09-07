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
				<th scope="col">ripristina</th>
                <th>elimina definitivamente</th>
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
                        <a class="btn btn-secondary" href="{{ route('apartments.restore', $apartment->id) }}">Restore</a>
					</td>
                    <td>
                        <form class="px-5 pb-5" action="{{ route('apartments.forceDelete', $apartment->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="bottone" class="btn btn-danger" type="submit">elimina 
                            </button>
                        </form>
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{-- {{ $bin->links('pagination::bootstrap-5') }} --}}

@endsection
