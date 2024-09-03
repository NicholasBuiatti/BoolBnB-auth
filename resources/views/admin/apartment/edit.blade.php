@extends('layouts.navBar')
{{-- da sistemare l'old che non va --}}

@section('content')
    <div class="d-flex align-items-start">

        <div class="h-100 w-100 overflow-auto">
            <form method="POST" action="{{ route('apartments.update', $apartment) }}" class="p-5"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Descrizione appartamento </label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') ?? $apartment->title }}" required>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Camere</label>
                    <input type="text" class="form-control" min="0" name="rooms"
                        value={{ old('rooms') ?? $apartment->rooms }} required>
                    @error('rooms')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Letti</label>
                    <input type="number" class="form-control" min="0" name="beds"
                        value={{ old('beds') ?? $apartment->beds }} required>
                    @error('beds')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Bagni </label>
                    <input type="number" class="form-control" min="0" name="bathrooms"
                        value={{ old('bathrooms') ?? $apartment->bathrooms }} required>
                    @error('bathrooms')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Dimensioni</label>
                    <input type="number" min="0" class="form-control" placeholder="in metri quadri"
                        name="dimension_mq" value={{ old('dimension_mq') ?? $apartment->dimension_mq }} required>
                    @error('dimension_mq')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Inserisci Immagine</label>
                    <input type="file" accept="image/*"  class="form-control" name="image"
                        value={{ old('image') ?? $apartment->image }} required>
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <p id="fileSizeError" style="color:red; display:none;">Il file supera le dimensioni massime di 5 mb.</p>
                </div>
                {{-- <div class="mb-3">
					<label class="form-label">Latitudine</label>
					<input type="text" class="form-control" name="latitude" value={{ old('latitude') ?? $apartment->latitude }}>
					@error('latitude')
						<div>{{ $message }}</div>
					@enderror
				</div>
				<div class="mb-3">
					<label class="form-label">Longitudine</label>
					<input type="text" class="form-control" name="longitude" value={{ old('longitude') ?? $apartment->longitude }}>
					@error('longitude')
						<div>{{ $message }}</div>
					@enderror
				</div> --}}
                <div class="mb-3">
                    <label class="form-label">Indirizzo </label>
                    <input type="text" class="form-control" name="address_full"
                        value="{{ old('address_full') ?? $apartment->address_full }}" required>
                    @error('address_full')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Modifica appartamento </button>
            </form>
            {{-- delete button --}}
            <form class="px-5 pb-5" action="{{ route('apartments.destroy', $apartment) }}" method="POST">
                @csrf
                @method('DELETE')
                <button id="bottone" class="btn btn-danger" type="submit">Elimina l'appartamento dalla tua lista </button>
            </form>
        </div>
    </div>
    <script>
       document.getElementById('image').addEventListener('change', function() {
        var file = this.files[0];
        if (file.size > 5 * 1024 * 1024) { 
            document.getElementById('fileSizeError').style.display = 'block';
            document.getElementById('bottone').preventDefault();
            
        } else {
            document.getElementById('fileSizeError').style.display = 'none';
        }
        
    });
    </script>
@endsection
