@extends('layouts.navBar')
{{-- da sistemare l'old che non va --}}

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
		<div class="form-edit">
			<form method="POST" action="{{ route('apartments.update', $apartment) }}" class="p-5" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="mb-3">
					<label class="form-label">descrizione appartamento </label>
					<input type="text" class="form-control" name="title" value={{ old('title') ?? $apartment->title }}>
					@error('title')
						<div>{{ $message }}</div>
					@enderror
				</div>
				<div class="mb-3">
					<label class="form-label">camere</label>
					<input type="text" class="form-control" name="rooms" value={{ old('rooms') ?? $apartment->rooms }}>
					@error('rooms')
						<div>{{ $message }}</div>
					@enderror
				</div>
				<div class="mb-3">
					<label class="form-label">letti</label>
					<input type="number" class="form-control" name="beds" value={{ old('beds') ?? $apartment->beds }}>
					@error('beds')
						<div>{{ $message }}</div>
					@enderror
				</div>
				<div class="mb-3">
					<label class="form-label">bagni </label>
					<input type="number" class="form-control" name="bathrooms" value={{ old('bathrooms') ?? $apartment->bathrooms }}>
					@error('bathrooms')
						<div>{{ $message }}</div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label">metratura</label>
					<input type="number" class="form-control" name="dimension_mq"
						value={{ old('dimension_mq') ?? $apartment->dimension_mq }}>
					@error('dimension_mq')
						<div>{{ $message }}</div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label">Inserisci Immagine</label>
					<input type="file" class="form-control" name="image" value={{ old('image') ?? $apartment->image }}>
					@error('image')
						<div>{{ $message }}</div>
					@enderror
				</div>
				<div class="mb-3">
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
				</div>
				<div class="mb-3">
					<label class="form-label">Indirizzo </label>
					<input type="text" class="form-control" name="address_full"
						value={{ old('address_full') ?? $apartment->address_full }}>
					@error('address_full')
						<div>{{ $message }}</div>
					@enderror
				</div>
				<button type="submit" class="btn btn-primary">Inserisci Appartamento </button>
			</form>
			{{-- delete button --}}
			<form class="px-5 pb-5" action="{{ route('apartments.destroy', $apartment) }}" method="POST">
				@csrf
				@method('DELETE')
				<button class="btn btn-danger" type="submit">elimina l'appartamento dalla tua lista </button>
			</form>
		</div>
	</div>
@endsection
