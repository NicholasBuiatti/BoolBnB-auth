@extends('layouts.navBar')

@section('content')
	<table class="table table-hover">

		<thead class="">
			<tr class="table-dark text-center">
				<th scope="col">RICEVUTO</th>
				<th scope="col">DA</th>
				<th scope="col">EMAIL</th>
				<th scope="col">RELATIVO ALL'APPARTAMENTO:</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody class="text-center align-middle">
			@foreach ($messages as $message)
				<tr>
					<th scope="row">{{ $message->created_at }}</th>
					<td>{{ $message->name }}</td>
					<td>{{ $message->email }}</td>
					<td>{{ $message->apartment->title }}</td>
					<td>
						<a class="btn btn-primary my-2" href="{{ route('message.show', $message->id) }}"><i
								class="fa-solid fa-eye"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
{{-- {{ $messages->links('pagination::bootstrap-5') }} --}}
