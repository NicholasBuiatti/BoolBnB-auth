@extends('layouts.navBar')

@section('content')
	<div class="d-flex align-items-start w-100">
		<form method="POST" action="{{ route('apartments.store') }}" class="w-100 p-5" enctype="multipart/form-data">
			@csrf
			<div class="mb-3">
				<label class="form-label">Descrizione appartamento </label>
				<input type="text" class="form-control" name="title" required value="{{ old('title')   }}">
				@error('title')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-3">
				<label class="form-label">Camere</label>
				<input type="number" min="1" class="form-control" name="rooms" required value="{{ old('rooms')   }}">
				@error('rooms')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-3">
				<label class="form-label">Letti</label>
				<input type="number" min="1" class="form-control" name="beds" required value="{{ old('beds') }}">
				@error('beds')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-3">
				<label class="form-label">Bagni </label>
				<input type="number" min="1" class="form-control" name="bathrooms" required value="{{ old('bathrooms')   }}">
				@error('bathrooms')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>

			<div class="mb-3">
				<label class="form-label">Dimensioni</label>
				<input type="number" min="1" class="form-control" name="dimension_mq" placeholder="in metri quadri" required value="{{ old('dimension_mq')   }}">
				@error('dimension_mq')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
image
			<div class="mb-3">
				<label class="form-label">Inserisci Immagine</label>
					<input type="file" class="form-control" name="image" placeholder="" required value="{{ old('image')  }}">
				@error('image')
					<div class="text-danger">{{ $message }}</div>
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
				<input type="text" class="form-control" name="address_full" placeholder="inserisci numero per tipo progetto"
					required value="{{ old('address_full')   }}">
				@error('address_full')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
			<button type="submit" class="btn btn-primary" id='btnSend'>Inserisci Appartamento </button>
		</form>
	</div>
@endsection
