@extends('layouts.app')

@section('content')
	@foreach ($catalogue as $apartment)
		<h3>{{ $apartment->title }}</h3>
		<p>{{ $apartment->rooms }}</p>
		<p>{{ $apartment->beds }}</p>
		<p>{{ $apartment->bathrooms }}</p>
		@if (Str::startsWith($apartment->image,'http'))
		<img width="140" src="{{$apartment->image}}" alt="">
		@else
		<img width="140" src="{{asset('storage/' . $apartment->image)}}" alt="">
		@endif
		<a href="{{ route('apartments.edit', $apartment->id) }}">{{ $apartment->title }}</a>
	@endforeach
@endsection
