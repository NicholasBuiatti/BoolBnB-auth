@extends('layouts.navBar')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-between align-items-start contenuto">
            <h2 class="card-title mb-3">{{ $apartment->title }}</h2>
            <!-- Colonna immagine -->
            <div class="row col-12 mb-4">
                <div class="col-12 col-md-7">
                    @if (Str::startsWith($apartment->image, 'http'))
                        <img style="max-height: 500px; width: 100%;" class="img-fluid rounded object-fit-cover"
                            src="{{ $apartment->image }}" alt="{{ $apartment->title }}">
                    @else
                        <img style="max-height: 500px; width: 100%;" class="img-fluid rounded object-fit-cover"
                            src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->title }}">
                    @endif
                </div>

                <!-- Dettagli appartamento sotto l'immagine -->
                <div class="col-12 col-md-5 d-flex flex-column justify-content-between">
                    <div>
                        <p><i class="fa-solid fa-house"></i> Indirizzo: {{ $apartment->address_full }}</p>
                        @if ($lastSponsorship)
                            <p><i class="fa-solid fa-eye"></i> Fine Sponsorizzazione:
                                {{ $lastSponsorship->pivot->ending_date }}
                            </p>
                        @else
                            <p><i class="fa-solid fa-eye-slash"></i> Non Sponsorizzato</p>
                        @endif
                    </div>
                    <div>
                        <h3>Caratteristiche</h3>
                        <p><i class="fa-solid fa-person-shelter"></i> Stanze: {{ $apartment->rooms }}</p>
                        <p><i class="fa-solid fa-bed"></i> Letti: {{ $apartment->beds }}</p>
                        <p><i class="fa-solid fa-bath"></i> Bagni: {{ $apartment->bathrooms }}</p>
                        <p><i class="fa-solid fa-maximize"></i> Superficie: {{ $apartment->dimension_mq }}mq</p>
                    </div>
                    <div>
                        <h3 class="mt-4">Servizi:</h3>
                        <ul class="list-unstyled d-flex flex-wrap">
                            @foreach ($apartment->services as $service)
                                <li class="me-3"><i class="fa-solid fa-check"></i> {{ $service->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-5 d-flex justify-content-between">
                        <a class="btn btn-primary" href="{{ route('apartments.index') }}"><i
                                class="fa-solid fa-arrow-left"></i></a>
                        <div>
                            <a class="modifica btn btn-secondary text-dark me-2"
                                href="{{ route('apartments.edit', $apartment->id) }}"><i class="fa-solid fa-pen"></i></a>
                            <!-- Bottone di cancellazione con modale -->
                            <button type="button" class="elimina  text-dark btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modal-{{ $apartment->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                            <!-- Modale per la cancellazione -->
                            <div class="modal fade text-danger" id="modal-{{ $apartment->id }}" tabindex="-1"
                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                aria-labelledby="modalTitle-{{ $apartment->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitle-{{ $apartment->id }}">Cancellazione</h5>
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
                                            <form action="{{ route('apartments.destroy', $apartment) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">Elimina</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>


        <div class="row">
            <div class="col-12 col-md-4 col-lg-4 mt-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-primary text-dark"
                        style="background: linear-gradient(130deg, #ffd489, #8cd7f2);">
                        <h5 class="card-title mb-0">Statistiche appartamento</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            In questa sezione puoi monitorare le statistiche delle visite al tuo appartamento. Tieni traccia
                            delle visualizzazioni, interazioni e altri dati utili per capire meglio il rendimento della tua
                            inserzione.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8 col-lg-8 mb-4">
                <canvas id="myChart"></canvas>

            </div>
        </div>
    </div>

    <style>
        .modifica {
            background-color: #ffffff !important;
            border: 2px solid #ffdd008c !important;
        }

        .modifica:hover {
            background-color: #ffdd0065 !important;
            border: 2px solid #ffdd0074 !important;
        }

        .elimina {
            background-color: #ffffff;
            border: 2px solid #ff74748c !important;
        }

        .elimina:hover {
            background-color: rgba(237, 140, 140, 0.616);
            border: 2px solid #ff747483 !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const months = @json($months);
        const monthlyData = @json(array_values($monthlyData));
        console.log(monthlyData);
        console.log(months);
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Numero di visite',
                    data: monthlyData,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                        }
                    }
                }
            }
        });
    </script>

    <style>
        @media screen and (max-width: 990px) {
            .contenuto {
                margin-top: 5.5rem;
            }
        }

        @media screen and (max-width: 455px) {
            .contenuto {
                margin-top: 4rem;
            }
        }
    </style>
@endsection
