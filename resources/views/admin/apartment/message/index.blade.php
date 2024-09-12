@extends('layouts.navBar')

@section('content')
	<table class="table table-striped table-responsive shadow-lg rounded"
		style="background-color: #f5f7fa; border-collapse: separate; border-spacing: 0 1rem; max-width: 1400px;">
		<thead class="text-center" style="background-color: #34495e; color: #ecf0f1; border-radius: 8px;">
			<tr class="d-none d-md-table-row">
				<th></th>
				<th scope="col" class="text-uppercase">RICEVUTO</th>
				<th scope="col" class="text-uppercase">DA</th>
				<th scope="col" class="text-uppercase">EMAIL</th>
				<th scope="col" class="text-uppercase">RELATIVO ALL'APPARTAMENTO:</th>
				<th scope="col" class="text-uppercase"></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($messages as $message)
				<tr class="text-center align-middle" style="background-color: #ffffff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">

					<th scope="row" class="d-block d-sm-table-cell col-12 col-md-5">
						<img class="rounded shadow-sm" src="{{ $message->apartment->image }}" alt="Immagine appartamento"
							style="height: 8rem; width:15rem; object-fit: cover;">
					</th>
					<td class="d-block d-sm-table-cell col-12 col-md-3">
						<h3 class="fs-4 title-shadow">{{ $message->created_at }}</h3>
					</td>

					<td class="d-block d-sm-table-cell col-12 col-md-3">
						<h3 class="fs-4 title-shadow">{{ $message->email }}</h3>
					</td>

					<td class="d-block d-sm-table-cell col-12 col-md-3">
						<h3 class="fs-4 title-shadow">{{ $message->apartment->title }}</h3>
					</td>

					<td class="d-block d-sm-table-cell col-12 col-md-3">
						<a class="btn btn-primary my-2" href="{{ route('message.show', $message->id) }}"><i
								class="fa-solid fa-eye"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
		{{ $messages->links('pagination::bootstrap-5') }}
	</table>
@endsection
