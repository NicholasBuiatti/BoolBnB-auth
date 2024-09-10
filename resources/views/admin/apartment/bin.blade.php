@extends('layouts.navBar')

@section('content')
	<table class="table table-hover">

		<thead class="">
			<tr class="table-dark text-center">
				<th scope="col"></th>
				<th scope="col">Nome</th>
				<th scope="col">Data di cancellazione</th>
				<th scope="col">ripristina</th>
				<th>elimina definitivamente</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($bin as $apartment)
				<tr class="align-middle text-center">
					<th scope="row">
						<img class="object-fit" src="{{ $apartment->image }}" alt="" style="height: 10rem; width:12rem">
					</th>
					<td class="fs-2 fw-bolder">{{ $apartment->title }}</td>
					<td>
						{{ $apartment->deleted_at }}
					</td>
					<td>
						<a class="btn btn-secondary" href="{{ route('apartments.restore', $apartment->id) }}">Ripristina</a>
					</td>
					<td>

						{{-- BOTTONE CHE ATTIVA IL MODALE --}}
						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{ $apartment->id }}">
							Cancella
						</button>
						{{-- MODALE DI BOOTSTRAP --}}
						<div class="modal fade text-danger" id="modal-{{ $apartment->id }}" tabindex="-1" data-bs-backdrop="static"
							data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $apartment->id }}" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalTitle-{{ $apartment->id }}">
											Cancellazione
										</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<div class="modal-body">
										Stai cancellando l'appartamento: {{ $apartment->title }}
										<br>Sicuro di proseguire??
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
											Close
										</button>

										<form action="{{ route('apartments.destroy', $apartment) }}" method="POST">
											@csrf
											@method('DELETE')
											<button class="btn btn-danger" type="submit">Elimina
											</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
			@endforeach

		</tbody>
	</table>
	{{-- {{ $bin->links('pagination::bootstrap-5') }} --}}
@endsection
