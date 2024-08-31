@extends('layouts.app')

@section('content')
	@foreach ($catalogue as $apartment)
		<h3>{{ $apartment->title }}</h3>
		<p>{{ $apartment->rooms }}</p>
		<p>{{ $apartment->beds }}</p>
		<p>{{ $apartment->bathrooms }}</p>
		<img src="" alt="">
		<a href="{{ route('apartments.edit', $apartment->id) }}">{{ $apartment->title }}</a>
	@endforeach
@endsection
