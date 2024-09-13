@extends('layouts.navBar')

@section('content')
	<div class="rounded overflow-hidden contenitore">
		<table class="table table-responsive shadow-lg w-75 m-auto w-md-100">
			<thead class="text-center">
				<tr class="d-none d-lg-table-row" style=" background: linear-gradient(130deg, #ebb7568a, #5fa2baa0) !important;">
					<th scope="col"></th>
					<th scope="col" class="text-uppercase">Nome Appartamento</th>
					<th scope="col" class="text-uppercase">DATA RICEZIONE</th>
					<th scope="col" class="text-uppercase">DA</th>
					<th scope="col" class="text-uppercase">DETTAGLI</th>
				</tr>
			</thead>
			<tbody class="">
				@foreach ($messages as $message)
					<tr class="text-center align-middle bordato"
						style=" background: linear-gradient(130deg, #d9b5738a, #5fa2baa0) !important;">

						<th scope="row" class="d-block d-md-table-cell col-12 col-lg-2">
							<img class="rounded shadow-sm" src="{{ $message->apartment->image }}" alt="Immagine appartamento"
								style="height: 8rem; width:15rem; object-fit: cover;">
						</th>
						<td class="d-block d-md-table-cell col-12 col-md-3">
							<h3 style="color: #6f5a4a" class="fs-4"><span
									class="sparisci">Appartamento:</span>{{ $message->apartment->title }}</h3>
						</td>
						<td class="d-block d-md-table-cell col-12 col-md-3">
							<h3 style="color: #6f5a4a" class="fs-4"><span class="sparisci">Ricevuto:</span>
								{{ $message->created_at }}</h3>
						</td>
						<td class="d-block d-md-table-cell col-12 col-md-3">
							<h3 style="color: #6f5a4a" class="fs-4"><span class="sparisci">Da:</span>
								{{ $message->email }}</h3>
						</td>
						<td class="d-block d-md-table-cell col-12 col-lg-3">
							<a class="visualizza btn btn-light border" href="{{ route('message.show', $message->id) }}"><span
									class="sparisci me-2">Dettagli</span><i class="fa-solid fa-magnifying-glass"></i></a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div class="altezza">
	{{ $messages->links('pagination::bootstrap-5') }}


	<style>
		.contenitore {
			box-shadow: 3px 3px 10px 1px;
		}

		td,
		th {
			background-color: rgba(235, 245, 246, 0.74) !important;
		}

		.tempo-spon {
			color: #ffffff;
			background-color: #2978ff;
			width: 15rem;
			border-radius: 15px
		}

		.eye {
			color: #473a32;
			border: 2px solid #6f5a4a;
			padding: 1rem;
			border-radius: 20px
		}

		.visualizza {
			background-color: #cbe5eb;
			width: 9rem;
		}

		.visualizza:hover {
			background-color: #8cdbed;
		}

		.modifica {
			background-color: #cfa165;
			width: 9rem;
		}

		.altezza {
			height: 3.2rem;
		}

		.sparisci {
			display: none
		}

		@media screen and (min-width:768px) {
			.w-md-100 {
				width: 100% !important;
			}
		}

		@media screen and (max-width:990px) {
			.w-md-100 {
				margin-top: 7rem !important;
			}
		}

		@media screen and (max-width:768px) {
			.w-md-100 {
				margin-top: 6rem !important;
			}

			.bordato {
				border: 3px solid rgb(101, 167, 217);
			}

			th {
				border: none !important;
			}

			td {
				border: none !important;
			}

			.sparisci {
				display: unset;
			}
		}
	</style>




	{{-- <div class="rounded overflow-hidden contenitore">
        <table class="table table-responsive shadow-lg w-75 m-auto w-md-100">
            <thead class="text-center">
                <tr class="d-none d-lg-table-row"
                    style=" background: linear-gradient(130deg, #ebb7568a, #5fa2baa0) !important;">
                    <th></th>
                    <th scope="col" class="text-uppercase">DATA RICEZIONE</th>
                    <th scope="col" class="text-uppercase">DA</th>
                    <th scope="col" class="text-uppercase">APPARTAMENTO</th>
                    <th scope="col" class="text-uppercase">DETTAGLI</th>
                    <th scope="col" class="text-uppercase"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr class="text-center align-middle bordato"
                        style=" background: linear-gradient(130deg, #d7b5768a, #5ca1baa0) !important;">

                        <th scope="row" class="d-block d-md-table-cell col-12 col-lg-3">
                            <img class="rounded shadow-sm" src="{{ $message->apartment->image }}"
                                alt="Immagine appartamento" style="height: 8rem; width:15rem; object-fit: cover;">
                        </th>
                        <td class="d-block d-md-table-cell col-12 col-md-3">
                            <h3 class="fs-4 title-shadow"><span class="sparisci">Ricevuto:</span> {{ $message->created_at }}
                            </h3>
                        </td>

                        <td class="d-block d-md-table-cell col-12 col-md-3">
                            <h3 class="fs-4 title-shadow"><span class="sparisci">Da:</span> {{ $message->email }}</h3>
                        </td>

                        <td class="d-block d-md-table-cell col-12 col-md-3">
                            <h3 class="fs-4 title-shadow"><span class="sparisci">Appartamento:</span>
                                {{ $message->apartment->title }}</h3>
                        </td>

                        <td class="d-block d-md-table-cell col-12 col-md-3">
                            <a class="btn btn-primary my-2" href="{{ route('message.show', $message->id) }}"><span
                                    class="sparisci">Dettagli</span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            {{ $messages->links('pagination::bootstrap-5') }}
        </table>
    </div>

    <style>
        .contenitore {
            box-shadow: 3px 3px 10px 1px;
        }

        td,
        th {
            background-color: rgba(235, 245, 246, 0.74) !important;
        }

        .eye {
            color: #473a32;
            border: 2px solid #6f5a4a;
            padding: 1rem;
            border-radius: 20px
        }

        .sparisci {
            display: none;
        }

        @media screen and (min-width:768px) {
            .w-md-100 {
                width: 100% !important;
            }
        }

        @media screen and (max-width:990px) {
            .w-md-100 {
                margin-top: 7rem !important;
            }
        }

        @media screen and (max-width:768px) {
            .w-md-100 {
                margin-top: 6rem !important;
            }

            .bordato {
                border: 3px solid rgb(101, 167, 217) !important;
            }

            th {
                border: none !important;
            }

            td {
                border: none !important;
            }

            .sparisci {
                display: unset;
            }
        }
    </style> --}}
@endsection
