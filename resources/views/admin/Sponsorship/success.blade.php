@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <div class="card m-auto col-12 col-md-6 shadow  border border-succes" style="background: rgb(246, 248, 244)">
            <h2 class="card-title mt-5 mb-3 text-center">Grazie per la sponsorizzazione!</h2>
            <div class="card-body text-center">
                <p class="card-text">Il pagamento è stato completato con successo! Grazie per aver scelto di sponsorizzare il
                    tuo appartamento sul nostro sito. La tua inserzione avrà ora maggiore visibilità, aiutandoti a
                    raggiungere più persone. Se hai bisogno di assistenza, siamo sempre qui per aiutarti!
                </p>
                <div class="text-start">
                    <a class="btn btnmy rounded-circle" href="{{ route('apartments.index') }}">
                        <i class="fa-solid fa-arrow-left"></i>
                        Torna ai tuoi appartmanenti</a>
                </div>
            </div>
        </div>


    </div>

    <style>
        .btnmy {
            background-color: rgba(0, 128, 0, 0.13);
            border-radius: 5px !important;
        }

        .btnmy:hover {
            background-color: rgba(0, 128, 0, 0.371);
        }

        .btnmy i {
            margin-right: 5px;
        }
    </style>
@endsection
