@extends('layouts.navBar')

@section('content')
    <section class="container mt-4 pt-5">
        <div class="row gy-4">
            <!-- Numero di visite Section -->
            <div class="col-12">
                <div class="background p-4 shadow rounded-3 custom-bg text-center">
                    <h5 class="mb-0">Statistiche delle visite</h5>
                    <div class="d-flex justify-content-center align-items-center mt-3">
                        <i class="fa-solid fa-chart-line fa-2x custom-icon me-3"></i>
                        <h3 class="mb-0 fw-bold">
                            visite dei miei appartamenti nel mese corrente: {{ $visitCount ?? 0 }}
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Messaggi Section -->
            <div class="col-lg-6">
                <div class="background p-4 shadow rounded-3 custom-bg">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Messaggi ricevuti</h5>
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
                                <a href="{{ route('message.show', $message->id) }}" class="btn btn-sm custom-btn ms-3">
                                    <i class="fa-solid fa-reply"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('message.index') }}" class="btn custom-btn mt-3 w-100">
                        Visualizza tutti i messaggi
                    </a>
                </div>
            </div>

            <!-- Appartamenti Section -->
            <div class="col-lg-6">
                <div class="background p-4 shadow rounded-3 custom-bg">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">I miei appartamenti</h5>
                        <span class="badge custom-badge">{{ $catalogue->total() }} totali</span>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($catalogue as $apartment)
                            <li
                                class="list-group-item custom-list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">{{ $apartment->title }}</div>
                                </div>
                                <a href="{{ route('apartments.show', $apartment->id) }}" class="btn btn-sm custom-btn ms-3">
                                    Dettagli
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('apartments.index') }}" class="btn custom-btn mt-3 w-100">
                        Vai alla lista dettagliata
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style scoped>
        .background {
            background: linear-gradient(130deg, #ebdcc13e, #a3ccdb64);
        }

        .custom-btn {
            background-color: rgba(255, 255, 255, 0.405);
            border: 3px solid #d8cfc4;
            color: #5c5853;
            transition: background-color 0.3s ease;
        }

        .custom-btn:hover {
            background-color: #aea8a1;
            color: #333;
        }

        .custom-badge {
            background-color: #658693;
            color: white;
        }

        .custom-list-group-item {
            background-color: #ffffff92;
            border: 1px solid #d8cfc4;
            color: #333;
        }

        .custom-icon {
            color: #658693;
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
