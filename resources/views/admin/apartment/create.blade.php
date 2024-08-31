@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('apartments.store') }}" class="p-5" enctype="multipart/form-data">
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
            <label for="cover_image" class="form-label">Choose file</label>
            <input type="number" class="form-control" name="bathrooms" id="cover_image" placeholder=""
                aria-describedby="coverImageHelper" />
            <div id="coverImageHelper" class="form-text">cover_image</div>
            @error('cover_image')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div> --}}
        <div class="mb-3">
            <label class="form-label">Latitudine</label>
            <input type="text" class="form-control" name="latitude" placeholder="inserisci numero per tipo progetto">
            @error('latitude')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Longitudine</label>
            <input type="text" class="form-control" name="longitude" placeholder="inserisci numero per tipo progetto">
            @error('longitude')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Indirizzo </label>
            <input type="text" class="form-control" name="address_full" placeholder="inserisci numero per tipo progetto">
            @error('address_full')
                <div>{{ $message }}</div>
            @enderror
        </div>
        {{-- <div class="mb-3">
            <label class="form-label">visibilità appartamento</label>
            <input type="checkbox" class="" value=true name="is_visible" >
            @error('is_visible')
                <div>{{ $message }}</div>
            @enderror
        </div> --}}


        <button type="submit" class="btn btn-primary">Inserisci Appartamento </button>
    </form>
@endsection
