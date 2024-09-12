@extends('layouts.navBar')

@section('content')
    <div class="rounded overflow-hidden">
        <table class="table table-responsive shadow-lg w-75 m-auto w-md-100">
            <thead class="text-center">
                <tr class="d-none d-lg-table-row">
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
                    <tr class="text-center align-middle bordato">

                        <th scope="row" class="d-block d-md-table-cell col-12 col-lg-2">
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
                                    class="sparisci">Dettagli</span> <i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            {{ $messages->links('pagination::bootstrap-5') }}
        </table>
    </div>

    <style>
        main {
            position: relative;
            background-color: #e9e9e9;
            background-image: url('/back.png');
            background-repeat: no-repeat;
            background-size: 80%;
            background-position: bottom right;
            background-size: 40vw;
            z-index: 1;
        }

        main::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
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
    </style>
@endsection
