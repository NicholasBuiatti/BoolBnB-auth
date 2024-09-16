@extends('layouts.navBar')

@section('content')
    <section class="container mt-4 pt-5">
        <div class="row gy-4">
            <!-- Numero di visite Section -->
            <div class="col-12">
                <div class="background shadow rounded-3">
                    <div class=" background-white p-4 rounded-3 custom-bg text-center">
                        <h5 class="mb-0">Statistiche delle visite</h5>
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <i class="fa-solid fa-chart-line fa-2x custom-icon me-3"></i>
                            <h3 class="mb-0 fw-bold">
                                visite dei miei appartamenti nel mese corrente: {{ $visitCount ?? 0 }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Messaggi Section -->
            <div class="col-lg-6">
                <div class="background shadow rounded-3">
                    <div class="background-white p-4 rounded-3 custom-bg">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="mb-0">Messaggi ricevuti</h4>
                            <span class="badge custom-badge">{{ $messages->total() }} messaggi</span>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($messages as $message)
                                <li
                                    class="list-group-item custom-list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ $message['apartment']->title }}</div>
                                        <span class="text-muted">{{ $message['email'] }}</span>
                                    </div>
                                    <small class="text-muted">{{ $message['created_at']->format('d M Y, H:i') }}</small>
                                    <div class="background rounded-3  ms-3">
                                        <a href="{{ route('message.show', $message->id) }}"
                                            class="background-white rounded-3 btn btn-sm custom-btn">
                                            <i class="fa-solid fa-reply"></i>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="background rounded-3  mt-3">
                            <a href="{{ route('message.index') }}" class="background-white fw-bold btn custom-btn w-100">
                                Visualizza tutti i messaggi
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Appartamenti Section -->
            <div class="col-lg-6">
                <div class="background shadow rounded-3">
                    <div class="background-white p-4 rounded-3 custom-bg">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="mb-0">I miei appartamenti</h4>
                            <span class="badge custom-badge">{{ $catalogue->total() }} totali</span>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($catalogue as $apartment)
                                <li
                                    class="list-group-item custom-list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ $apartment->title }}</div>
                                    </div>
                                    <div class="background rounded-3  ms-3">
                                        <a href="{{ route('apartments.show', $apartment->id) }}"
                                            class="btn btn-sm custom-btn background-white">
                                            Dettagli
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="background rounded-3  mt-3">
                            <a href="{{ route('apartments.index') }}"
                                class="btn custom-btn fw-bold background-white w-100">
                                Vai alla lista dettagliata
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style scoped>
        .background {
            /* background: linear-gradient(130deg, #ebdcc13e, #a3ccdb64); */
            background: linear-gradient(130deg, #ffd489a4, #8cd7f298) !important;
            padding: .2rem
        }

        .background-white {
            background: rgb(255, 255, 255);
        }

        .custom-btn {
            background-color: rgba(255, 255, 255, 0.931);

            /* border: 3px solid #5dd1d7; */
            color: #5c5853;
            transition: background-color 0.3s ease;
        }

        .custom-btn:hover {
            background-color: #ffffff9e;
            color: #333;
        }

        .custom-badge {
            background-color: #1face3;
            color: white;
        }

        .custom-list-group-item {
            background-color: #f9f9f992;
            border: 1px solid #d8cfc4;
            color: #333;
        }

        .custom-icon {
            color: #16aae4;
        }

        .text-primary {
            color: #333;
        }

        @media screen and (max-width: 990px) {
            .contenuto {
                margin-top: 3rem;
            }
        }
    </style>
@endsection
