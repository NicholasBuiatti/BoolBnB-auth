@extends('layouts.navBar')

@section('content')
    <div class="container-xl px-0 w-md-100">
        <div class="d-flex justify-content-between align-items-center container-xl mb-4">
            <h2>Lista appartamenti</h2>
            <div class="d-none d-md-block add-apartment shadow"><a class="text-decoration-none"
                    href="{{ route('apartments.create') }}">Aggiungi
                    appartamento</a>
            </div>
            <div class="d-md-none add-apartment-mobile shadow"><a href="{{ route('apartments.create') }}"><i
                        class="fa-solid fa-plus"></i></a>

            </div>
        </div>
        <div class="rounded overflow-hidden shadow">
            <table class="d-none d-md-block table table-responsive shadow-lg w-100 m-auto ">
                <thead class="text-center">
                    <tr class="d-none d-md-table-row"
                        style="background: linear-gradient(130deg, #ffd489a4, #8cd7f298) !important;">
                        <div>
                            <th scope="col">
                                <i class=" bold fa-solid fa-camera"></i>
                            </th>
                            <th scope="col" class="text-uppercase">
                                <i class="fa-solid fa-house-flag"></i> <span>Titolo</span>
                            </th>
                            <th scope="col" class="text-uppercase">
                                <i class="fa-solid fa-bullhorn"></i> <span>Sponsorizzazione</span>
                            </th>
                            <th scope="col" class="text-uppercase">
                                <i class="fa-solid fa-eye"></i> <span>Visibilità</span>
                            </th>
                            <th scope="col" class="text-uppercase">
                                <i class="fa-solid fa-sliders"></i> <span>Azioni</span>
                            </th>
                        </div>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach ($catalogue as $apartment)
                        <tr class="text-center align-middle" style="height: 1rem">

                            <td scope="row" class="d-none d-md-table-cell col">
                                <img class="rounded shadow-sm" src="{{ $apartment->image }}" alt="Immagine appartamento"
                                    style="height: 6rem; width:12rem; object-fit: cover;">
                            </td>
                            <td class="d-none d-md-table-cell col-8">
                                <h4 style="color: #6f5a4a" class="fs-4">{{ $apartment->title }}</h4>
                            </td>


                            <td class="d-none d-md-table-cell col">
                                <div class="d-flex flex-column justify-content-center align-items-center">

                                    @if ($apartment->lastSponsorship)
                                        <p class="tempo-spon m-1">Termine sponsorizzazione <br>
                                            {{ $apartment->lastSponsorship->pivot->ending_date }}</p>
                                    @endif
                                    <button class="btn btn-outline-primary rounded-4" type="button"
                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight-{{ $apartment->id }}"
                                        aria-controls="offcanvasRight">
                                        <i class="fa-solid fa-arrow-up-right-dots"></i>
                                        Sponsorizza ora
                                    </button>
                                </div>
                                <div class="offcanvas w-100 offcanvas-end" style="tabindex="-1"
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
                                                        <label for="sponsorship_{{ $sponsorship->id }}"
                                                            class="col-10 col-lg-4 sponsorship-label">
                                                            <div class="card mb-3 shadow p-3 mb-5 bg-body rounded sponsorship-card {{ $sponsorship->name == 'Premium' ? 'highlight' : '' }}"
                                                                style="
                                                                    {{ $sponsorship->name == 'Basic' ? 'background: linear-gradient(130deg, #CD7F32, #A0522D);' : '' }}  /* Bronzo */
                                                                    {{ $sponsorship->name == 'Premium' ? 'background: linear-gradient(130deg, #C0C0C0, #B0B0B0);' : '' }}  /* Argento */
                                                                    {{ $sponsorship->name == 'Elite' ? 'background: linear-gradient(130deg, #FFD700, #FFEC8B);' : '' }}  /* Oro */">

                                                                <div class="card-header text-uppercase fs-3 fw-bold">
                                                                    {{ $sponsorship->name }}
                                                                </div>
                                                                <div class="card-body">
                                                                    <p>{{ $sponsorship->description }}</p>
                                                                    <p class="fw-bold fs-3">€ {{ $sponsorship->price }}</p>
                                                                </div>
                                                            </div>

                                                            <input type="radio" name="sponsorship_id"
                                                                id="sponsorship_{{ $sponsorship->id }}"
                                                                value="{{ $sponsorship->id }}"
                                                                data-amount="{{ $sponsorship->price }}" class="d-none"
                                                                {{ $sponsorship->name == 'Premium' ? 'checked' : '' }}>
                                                        </label>
                                                    @endforeach

                                                </div>
                                                <div id="dropin-container-{{ $apartment->id }}"
                                                    class="col-10 col-lg-4 mx-auto shadow p-3 mb-5 rounded">
                                                </div>

                                                <button type="submit" class="btn btn-primary"
                                                    id="btnPagaOra">Conferma</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="d-none d-md-table-cell col-12">
                                <span class="sparisci fs-3">Visibilità: </span>
                                @if ($apartment->is_visible == 1)
                                    <i class="fa-solid fa-check fs-3 text-success"></i>
                                @else
                                    <i class="fa-solid fa-xmark fs-2 text-danger"></i>
                                @endif
                            </td>
                            <td class="d-none d-md-table-cell col">
                                <div class="d-flex pippo gap-1">
                                    <a class="col-4 visualizza p-0 btn btn-light my-1 rounded-3"
                                        href="{{ route('apartments.show', $apartment->id) }}">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </a>
                                    <a class="col-4 modifica btn p-0  btn-warning text-dark my-1 rounded-3"
                                        href="{{ route('apartments.edit', $apartment->id) }}">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <button type="button" class="col-4 btn p-0 btn-danger text-dark my-1 elimina rounded-3"
                                        data-bs-toggle="modal" data-bs-target="#modal-{{ $apartment->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <div class="modal fade text-danger" id="modal-{{ $apartment->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitle-{{ $apartment->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitle-{{ $apartment->id }}">
                                                        Cancellazione
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Stai cancellando l'appartamento: {{ $apartment->title }}<br>Sicuro di
                                                    proseguire?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Annulla</button>
                                                    <form action="{{ route('apartments.destroy', $apartment) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit">Elimina</button>
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
        </div>
        @foreach ($catalogue as $apartment)
            <div class="d-md-none">
                <div class="card w-100 mb-3">
                    <div class="row g-0">
                        <!-- Immagine dell'appartamento -->
                        <div class="col-md-4" style="height: 15rem">
                            <img src="{{ $apartment->image }}" class="img-fluid rounded" alt="Immagine appartamento"
                                style=" height: 100%; width: 100%; object-fit: cover;">
                        </div>
                        <!-- Contenuto della card -->
                        <div class="col-md-8">
                            <div class="card-body">
                                <!-- Titolo dell'appartamento -->
                                <h5 class="card-title text-center">{{ $apartment->title }}</h5>

                                <!-- Sponsorizzazione -->
                                <div class="d-flex flex-column">
                                    @if ($apartment->lastSponsorship)
                                        <p class="text-center text-primary">La sponsorizzazione termina
                                            il:
                                            {{ $apartment->lastSponsorship->pivot->ending_date }}</p>
                                    @endif
                                    <button class="btn btn-outline-primary rounded-4 mb-3" type="button"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasSponsor-{{ $apartment->id }}"
                                        aria-controls="offcanvasSponsor-{{ $apartment->id }}">
                                        <i class="fa-solid fa-arrow-up-right-dots"></i> Sponsorizza ora
                                    </button>
                                </div>
                                <div class="offcanvas w-100 offcanvas-end" style="" tabindex="-1"
                                    id="offcanvasSponsor-{{ $apartment->id }}"
                                    aria-labelledby="offcanvasSponsorLabel-{{ $apartment->id }}">

                                    <div class="offcanvas-header">
                                        <h1 class="mx-auto">Seleziona una Sponsorizzazione</h1>
                                        <button type="button" class="btn-close text-reset ms-0"
                                            data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>

                                    <div class="offcanvas-body">
                                        <div class="container">
                                            <form id="payment-form-mobile-{{ $apartment->id }}" method="POST"
                                                action="{{ route('sponsorships.payment', ['apartment' => $apartment->id]) }}">
                                                @csrf
                                                <div class="row justify-content-around">
                                                    @foreach ($sponsorships as $sponsorship)
                                                        <label for="sponsorship_{{ $sponsorship->id }}"
                                                            class="col-10 col-lg-4 sponsorship-label">
                                                            <div class="card mb-3 shadow p-3 mb-5 bg-body rounded sponsorship-card {{ $sponsorship->name == 'Premium' ? 'highlight' : '' }}"
                                                                style="
                                                                    {{ $sponsorship->name == 'Basic' ? 'background: linear-gradient(130deg, #CD7F32, #A0522D);' : '' }}  /* Bronzo */
                                                                    {{ $sponsorship->name == 'Premium' ? 'background: linear-gradient(130deg, #C0C0C0, #B0B0B0);' : '' }}  /* Argento */
                                                                    {{ $sponsorship->name == 'Elite' ? 'background: linear-gradient(130deg, #FFD700, #FFEC8B);' : '' }}  /* Oro */">

                                                                <div class="card-header text-uppercase fs-3 fw-bold">
                                                                    {{ $sponsorship->name }}
                                                                </div>
                                                                <div class="card-body">
                                                                    <p>{{ $sponsorship->description }}</p>
                                                                    <p class="fw-bold fs-3">€ {{ $sponsorship->price }}
                                                                    </p>
                                                                </div>
                                                            </div>


                                                            <input type="radio" name="sponsorship_id"
                                                                id="sponsorship_{{ $sponsorship->id }}"
                                                                value="{{ $sponsorship->id }}"
                                                                data-amount="{{ $sponsorship->price }}" class="d-none"
                                                                {{ $sponsorship->name == 'Premium' ? 'checked' : '' }}>
                                                        </label>
                                                    @endforeach
                                                </div>

                                                <div id="dropin-container-mobile-{{ $apartment->id }}"
                                                    class="col-10 col-lg-4 mx-auto shadow p-3 mb-5 rounded"></div>

                                                <button type="submit" class="btn btn-primary"
                                                    id="btnPagaOra">Conferma</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- Visibilità e azioni -->
                                <div class="d-flex justify-content-start gap-3 align-items-center mt-3">
                                    <span class="fs-5">Visibilità: </span>
                                    @if ($apartment->is_visible == 1)
                                        <i class="fa-solid fa-check fs-4 text-success"></i>
                                    @else
                                        <i class="fa-solid fa-xmark fs-4 text-danger"></i>
                                    @endif
                                </div>

                                <!-- Azioni -->
                                <div class="mobile d-flex justify-content-between mt-3">
                                    <a href="{{ route('apartments.show', $apartment->id) }}"
                                        class="visualizza col-3-5 btn btn-light"><i
                                            class="fa-solid fa-magnifying-glass"></i>
                                        Visualizza</a>
                                    <a href="{{ route('apartments.edit', $apartment->id) }}"
                                        class=" modifica col-3-5 btn btn-warning text-dark"><i
                                            class="fa-solid fa-pen"></i>
                                        Modifica</a>
                                    <button type="button" class="elimina text-dark col-3-5 btn btn-danger"
                                        data-bs-toggle="modal" data-bs-target="#modal-{{ $apartment->id }}">
                                        <i class="fa-solid fa-trash"></i> Elimina
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div class="altezza">
    {{ $catalogue->links('pagination::bootstrap-5') }}
    <style>
        /* Imposta lo stato iniziale dell'offcanvas su hidden */
        .offcanvas {
            visibility: hidden;
            transform: translateX(100%);
            /* Posiziona l'offcanvas fuori dallo schermo */
            /* transition: transform 0.4s ease-in-out, visibility 0.4s ease-in-out; */
        }

        /* Quando l'offcanvas è aperto (grazie a Bootstrap) */
        .offcanvas.show {
            visibility: visible;
            transform: translateX(0);
            /* Porta l'offcanvas in posizione visibile */
        }

        /* Transizione morbida per l'apertura dell'offcanvas */
        .offcanvas.show .offcanvas-body {
            transition: opacity 0.4s ease-in-out;
            opacity: 1;
        }

        /* Quando è chiuso, evita l'effetto di 'schizzo' */
        .offcanvas .offcanvas-body {
            opacity: 0;
        }


        .highlight {
            /* Imposta un colore predefinito per il bordo evidenziato */
            box-shadow: 0 0 15px 10px rgb(0, 0, 0) !important;
            /* Effetto ombra morbido */
            transition: all 0.4s ease-in-out;
            /* Aggiungi una transizione fluida */
        }

        .contenitore {
            box-shadow: 3px 3px 10px 1px;
        }

        td,
        th {
            background-color: rgba(255, 255, 255, 0) !important;
        }

        tr td {
            padding: 0 .5rem !important;
            border-bottom: 2px solid rgba(0, 0, 0, 0.155) !important;
        }

        .tempo-spon {
            color: #2978ff;
            background-color: #d2ebff;
            width: 12rem;
            border-radius: 15px
        }


        .visualizza {
            background-color: #ffffff;
            border: 2px solid #74ffdf7e;
            width: 3rem;
        }

        .visualizza:hover {
            background-color: rgba(140, 219, 237, 0.616);
            border: 2px solid #74ffdf84;
        }

        .elimina {
            background-color: #ffffff;
            border: 2px solid #ff74748c;
            width: 3rem;
        }

        .elimina:hover {
            background-color: rgba(237, 140, 140, 0.616);
            border: 2px solid #ff747483;
        }

        .modifica {
            background-color: #ffffff;
            border: 2px solid #ffdd008c;
            width: 3rem;
        }

        .modifica:hover {
            background-color: #ffdd0065;
            border: 2px solid #ffdd0074;
        }

        .mobile .visualizza,
        .mobile .modifica,
        .mobile .elimina {
            width: unset;
        }

        .add-apartment a {
            color: black !important;
            font-weight: 700 !important;
            font-size: 20px !important;
        }

        .add-apartment {
            background: linear-gradient(130deg, #ffd48994, #8cd7f28a);
            padding: .5rem;
            border-radius: 10px;
            cursor: pointer;
        }

        .add-apartment-mobile a {
            color: black !important;
            font-weight: 700 !important;
            font-size: 35px !important;
        }

        .add-apartment-mobile {
            background: linear-gradient(130deg, #ffd489f5, #8cd7f2ef);
            padding: .5rem;
            border-radius: 10px;
            font-weight: 700 !important;
            font-size: 35px;
            cursor: pointer;
            width: 3rem;
            height: 3rem;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            bottom: 2rem;
            right: 2rem;
            z-index: 999;


        }

        .add-apartment:hover {
            background: linear-gradient(130deg, #ffd489, #8cd7f2);
        }

        .altezza {
            height: 3.2rem;
        }

        .sparisci {
            display: none
        }

        .col-3-5 {
            width: calc(100% / 12 * 3.8);
        }

        @media screen and (min-width:768px) {
            .w-md-100 {
                width: 100% !important;
            }
        }

        @media screen and (max-width:839px) {
            .disappear {
                display: none !important;
            }

            .pippo {
                flex-direction: column;
            }

            .visualizza,
            .modifica,
            .elimina {
                width: 3rem;
            }
        }

        @media screen and (max-width:990px) {
            .w-md-100 {
                margin-top: 6rem !important;
            }
        }

        @media screen and (max-width:768px) {
            .w-md-100 {
                margin-top: 6rem !important;
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

            .visualizza,
            .modifica,
            .elimina {
                width: 4rem;
            }
        }
    </style>

    <script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>
    <script>
        document.querySelectorAll('.sponsorship-card').forEach(card => {
            card.addEventListener('click', function() {
                // Rimuovi la classe highlight da tutte le carte
                document.querySelectorAll('.sponsorship-card').forEach(c => c.classList.remove(
                    'highlight'));

                // Aggiungi la classe highlight alla carta cliccata
                this.classList.add('highlight');
            });
        });

        document.querySelectorAll('button[data-bs-toggle="offcanvas"]').forEach(function(button) {
            button.addEventListener('click', function() {
                // Recupera l'id dell'appartamento dal data-bs-target
                var apartmentId = this.getAttribute('data-bs-target').split('-').pop();

                // Seleziona il form e il dropin-container per l'appartamento specifico
                var form = document.querySelector('#payment-form-' + apartmentId);
                var formMobile = document.querySelector('#payment-form-mobile-' + apartmentId);
                var dropinContainerMobile = document.querySelector('#dropin-container-mobile-' +
                    apartmentId);
                var dropinContainer = document.querySelector('#dropin-container-' + apartmentId);

                // Inizializza Braintree Drop-in per questo specifico appartamento
                braintree.dropin.create({
                    authorization: "{{ $clientToken }}",
                    container: dropinContainerMobile,
                    locale: 'it' // Imposta la lingua italiana
                }, function(createErr, instance) {
                    if (createErr) {
                        console.error(createErr);
                        return;
                    }

                    formMobile.addEventListener('submit', function(event) {
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
