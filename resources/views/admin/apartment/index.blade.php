@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-start">
        <div id="right-dashboard" class="col-2">

            <h1>Dashboard</h1>
            <ul>
                <li><a href="{{ route('apartments.index') }}">Elenco Appartamenti</a></li>
                <li><a href="{{ route('apartments.create') }}">Inserisci nuovo appartamento</a></li>
                <li><a href="">Messaggi ricevuti</a></li>
                <li><a href="">Storico acquisti</a></li>
            </ul>
        </div>
        <div class="index-view d-flex flex-wrap">
            @foreach ($catalogue as $apartment)
                <div id="card-container" class="card col-3">
                    <div class="img-container">
                        @if (Str::startsWith($apartment->image, 'http'))
                            <img width="140" class="card-img-top" src="{{ $apartment->image }}" alt="">
                        @else
                            <img width="140" class="card-img-top" src="{{ asset('storage/' . $apartment->image) }}"
                                alt="">
                        @endif
                    </div>
                    <div class="card-body">
                        <h2 class="card-title">{{ $apartment->title }}</h2>
                        <p class="card-text">
                        <p><i class="fa-solid fa-person-shelter"></i> Stanze: {{ $apartment->rooms }}</p>
                        <p><i class="fa-solid fa-bed"></i> Letti: {{ $apartment->beds }}</p>
                        <p><i class="fa-solid fa-bath"></i> Bagni: {{ $apartment->bathrooms }}</p>
                        <p><i class="fa-solid fa-house"></i> Superficie: {{ $apartment->dimension_mq }}mq</p>
                        </p>
                        <a class="btn btn-primary" href="{{ route('apartments.edit', $apartment->id) }}">Modifica
                            appartamento</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
