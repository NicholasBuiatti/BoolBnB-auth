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
        <form method="POST" action="{{ route('apartments.store') }}" class="form-create p-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">descrizione appartamento </label>
                <input type="text" class="form-control" name="title">
                @error('title')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">camere</label>
                <input type="number" class="form-control" name="rooms">
                @error('rooms')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">letti</label>
                <input type="number" class="form-control" name="beds">
                @error('beds')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">bagni </label>
                <input type="number" class="form-control" name="bathrooms">
                @error('bathrooms')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">metratura</label>
                <input type="number" class="form-control" name="dimension_mq" placeholder="">
                @error('dimension_mq')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Inserisci Immagine</label>
                <input type="file" class="form-control" name="image" placeholder="">
                @error('image')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            {{-- <div class="mb-3">
                <label class="form-label">Latitudine</label>
                <input type="text" class="form-control" name="latitude" placeholder="inserisci numero per tipo progetto">
                @error('latitude')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Longitudine</label>
                <input type="text" class="form-control" name="longitude"
                    placeholder="inserisci numero per tipo progetto">
                @error('longitude')
                    <div>{{ $message }}</div>
                @enderror
            </div> --}}
            <div class="mb-3">
                <label class="form-label">Indirizzo </label>
                <input type="text" class="form-control" name="address_full"
                    placeholder="inserisci numero per tipo progetto">
                @error('address_full')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Inserisci Appartamento </button>
        </form>
    </div>
@endsection
