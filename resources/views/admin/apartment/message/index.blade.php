@extends('layouts.navBar')

@section('content')
	<table class="table table-hover">
		<thead>
			<tr>
				<th scope="col">Nome</th>
				<th scope="col">email</th>
				<th scope="col">messaggio</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($messages as $message)
				<tr>
					<th scope="row">{{ $message->name }}</th>
					<td>{{ $message->email }}</td>
					<td>{{ $message->text }}</td>
					<td>
						<ul>
							@foreach ($message->services as $service)
								<li>{{ $service->name }}</li>
							@endforeach
						</ul>
					</td>
					<td>
						<a class="btn btn-primary my-2" href="{{ route('apartments.show', $message->id) }}">D</a>
						<a class="btn btn-secondary" href="{{ route('apartments.edit', $message->id) }}">M</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{ $messages->links('pagination::bootstrap-5') }}
