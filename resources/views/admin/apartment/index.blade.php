@extends('layouts.navBar')

@section('content')
    <div class="rounded overflow-hidden">
        <table class="table table-responsive shadow-lg w-75 m-auto w-md-100">
            <thead class="text-center">
                <tr class="d-none d-lg-table-row">
                    <th scope="col"></th>
                    <th scope="col" class="text-uppercase">Nome Appartamento</th>
                    <th scope="col" class="text-uppercase">Sponsorizzazione</th>
                    <th scope="col" class="text-uppercase">Visibilità</th>
                    <th scope="col" class="text-uppercase">Azioni</th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($catalogue as $apartment)
                    <tr class="text-center align-middle bordato" style=" box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">

                        <th scope="row" class="d-block d-md-table-cell col-12 col-lg-2">
                            <img class="rounded shadow-sm" src="{{ $apartment->image }}" alt="Immagine appartamento"
                                style="height: 8rem; width:15rem; object-fit: cover;">
                        </th>
                        <td class="d-block d-md-table-cell col-12 col-md-3">
                            <h3 style="color: #6f5a4a" class="fs-4">{{ $apartment->title }}</h3>
                        </td>


                        <td class="d-block d-md-table-cell col-12 col-lg-3">
                            <div class="d-flex flex-column justify-content-center align-items-center gap-2">
                                <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasRight-{{ $apartment->id }}" aria-controls="offcanvasRight">
                                    <i class="fa-solid fa-bullhorn"></i> Sponsorizza
                                </button>
                                @if ($apartment->lastSponsorship)
                                    <p class="tempo-spon">La sponsorizzazione termina il: <br>
                                        {{ $apartment->lastSponsorship->pivot->ending_date }}</p>
                                @endif
                            </div>
                            <div class="offcanvas w-100 offcanvas-end"
                                style="background: linear-gradient(130deg, #fff6e7, #a8c2cb); tabindex="-1"
                                id="offcanvasRight-{{ $apartment->id }}"
                                aria-labelledby="offcanvasRightLabel-{{ $apartment->id }}">
                                <div class="offcanvas-header">
                                    <h1 class="mx-auto">Seleziona una Sponsorizzazione</h1>
                                    <button type="button" class="btn-close text-reset ms-0" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <div class="container">


                                        <form id="payment-form-{{ $apartment->id }}" method="POST"
                                            action="{{ route('sponsorships.payment', ['apartment' => $apartment->id]) }}">
                                            @csrf
                                            <div class="row justify-content-around">
                                                @foreach ($sponsorships as $sponsorship)
                                                    <div class="card border-info mb-3 col-10 col-lg-3 shadow p-3 mb-5 bg-body rounded"
                                                        style="{{ $sponsorship->name == 'Basic' ? 'background: linear-gradient(130deg, #f8ebd1, #b89a6e);' : '' }}
													    {{ $sponsorship->name == 'Premium' ? 'background: linear-gradient(130deg, #f0f4f8, #c0c0c0);' : '' }}
													    {{ $sponsorship->name == 'Elite' ? 'background: linear-gradient(130deg, #fff5e4, #f2c27f);' : '' }}">
                                                        <div class="card-header text-uppercase fs-3 fw-bold">
                                                            {{ $sponsorship->name }}</div>
                                                        <div class="card-body">
                                                            <p>{{ $sponsorship->description }}</p>
                                                            <input type="radio" name="sponsorship_id"
                                                                id="sponsorship_{{ $sponsorship->id }}"
                                                                value="{{ $sponsorship->id }}"
                                                                data-amount="{{ $sponsorship->price }}">
                                                            <label for="sponsorship_{{ $sponsorship->id }}">
                                                                {{ $sponsorship->name }} - €{{ $sponsorship->price }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                            <div id="dropin-container-{{ $apartment->id }}"
                                                class="col-10 col-lg-4 mx-auto shadow p-3 mb-5 rounded">
                                            </div>

                                            <button type="submit" class="btn btn-custom">Paga ora</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="d-block d-md-table-cell col-12 col-lg-3">
                            <span class="sparisci fs-3">Visibilità: </span>
                            @if ($apartment->is_visible == 1)
                                <i class="fa-solid fa-eye fs-3 eye"></i>
                            @else
                                <i class="fa-solid fa-eye-slash fs-3 eye"></i>
                            @endif
                        </td>
                        <td class="d-block d-md-table-cell col-12 col-lg-3">
                            <a class="visualizza btn btn-light border my-1"
                                href="{{ route('apartments.show', $apartment->id) }}">
                                <i class="fa-solid fa-magnifying-glass"></i> Visualizza
                            </a>
                            <a class="modifica btn btn-warning text-dark my-1"
                                href="{{ route('apartments.edit', $apartment->id) }}">
                                <i class="fa-solid fa-pen"></i> Modifica
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div class="altezza">
    {{ $catalogue->links('pagination::bootstrap-5') }}
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

    <script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>
    <script>
        document.querySelectorAll('button[data-bs-toggle="offcanvas"]').forEach(function(button) {
            button.addEventListener('click', function() {
                // Recupera l'id dell'appartamento dal data-bs-target
                var apartmentId = this.getAttribute('data-bs-target').split('-').pop();

                // Seleziona il form e il dropin-container per l'appartamento specifico
                var form = document.querySelector('#payment-form-' + apartmentId);
                var dropinContainer = document.querySelector('#dropin-container-' + apartmentId);

                // Inizializza Braintree Drop-in per questo specifico appartamento
                braintree.dropin.create({
                    authorization: "{{ $clientToken }}",
                    container: dropinContainer,
                    locale: 'it' // Imposta la lingua italiana
                }, function(createErr, instance) {
                    if (createErr) {
                        console.error(createErr);
                        return;
                    }

                    form.addEventListener('submit', function(event) {
                        event.preventDefault();

                        instance.requestPaymentMethod(function(err, payload) {
                            if (err) {
                                console.error(err);
                                return;
                            }

                            // Aggiungi il nonce nel form e invia
                            var nonceInput = document.createElement('input');
                            nonceInput.setAttribute('type', 'hidden');
                            nonceInput.setAttribute('name', 'payment_method_nonce');
                            nonceInput.setAttribute('value', payload.nonce);
                            form.appendChild(nonceInput);

                            form.submit();
                        });
                    });
                });
            });
        });
    </script>
@endsection
