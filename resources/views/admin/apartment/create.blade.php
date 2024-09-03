@extends('layouts.navBar')

@section('content')
    <div class="d-flex align-items-start w-100">
        <form id="apartmentForm" method="POST" action="{{ route('apartments.store') }}" class="w-100 p-5"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Descrizione appartamento </label>
                <input type="text" class="form-control" name="title" required value="{{ old('title') }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Camere</label>
                <input type="number" min="1" class="form-control" name="rooms" required
                    value="{{ old('rooms') }}">
                @error('rooms')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Letti</label>
                <input type="number" min="1" class="form-control" name="beds" required
                    value="{{ old('beds') }}">
                @error('beds')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Bagni </label>
                <input type="number" min="1" class="form-control" name="bathrooms" required
                    value="{{ old('bathrooms') }}">
                @error('bathrooms')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Dimensioni</label>
                <input type="number" min="1" class="form-control" name="dimension_mq" placeholder="in metri quadri"
                    required value="{{ old('dimension_mq') }}">
                @error('dimension_mq')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Inserisci Immagine</label>
                <input type="file" accept="image/*" id="image" class="form-control" name="image" placeholder=""
                    required">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <p id="fileSizeError" style="color:red; display:none;">Il file supera le dimensioni massime di 5 mb.</p>

            </div>
            <div class="mb-3">
                <label class="form-label">Indirizzo </label>
                <input type="text" class="form-control" name="address_full"
                    placeholder="inserisci numero per tipo progetto" required value="{{ old('address_full') }}">
                @error('address_full')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary" id='btnSend'>Inserisci Appartamento </button>
        </form>
    </div>
    <script>
        document.getElementById('image').addEventListener('change', function() {
            let file = this.files[0];
            if (file.size > 5 * 1024 * 1024) {
                document.getElementById('fileSizeError').style.display = 'block';
                // disabilito l'invio del form se il file è troppo grande
                document.getElementById('apartmentForm').onsubmit = function(event) {
                    event.preventDefault();
                }
            } else {
                document.getElementById('fileSizeError').style.display = 'none';
                // permetto l'invio del form se il file rispetta le dimensioni
                document.getElementById('apartmentForm').onsubmit = function(event) {
                    return true;
                };
            }

        });
    </script>
@endsection
