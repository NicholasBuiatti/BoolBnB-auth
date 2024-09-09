@extends('layouts.navBar')

@section('content')
	<table class="table table-hover">
		<thead>
			<tr>
				<th scope="col">Nome</th>
				<th scope="col">email</th>
				<th scope="col">messaggio</th>
				<th scope="col">Relativo all'appartamento:</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($messages as $message)
				<tr>
					<th scope="row">{{ $message->name }}</th>
					<td>{{ $message->email }}</td>
					<td>{{ $message->text }}</td>
					<td>{{$message->apartment->title}}</td>
					
				
				</tr>
			@endforeach
		</tbody>
	</table>
    @endsection
	{{-- {{ $messages->links('pagination::bootstrap-5') }} --}}
