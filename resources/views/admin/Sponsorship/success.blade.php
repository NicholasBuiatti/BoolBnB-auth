@extends('layouts.app')

@section('content')
	<div class="container">
		<h1>Grazie per la sponsorizzazione!</h1>
		<p>La tua transazione è stata completata con successo.</p>
	</div>
	<a class="btn btn-primary" href="{{ route('apartments.index') }}">back</a>
@endsection
