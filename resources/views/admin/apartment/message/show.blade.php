@extends('layouts.navBar')

@section('content')
	<div class="container w-md-100">
		<div class="card col-12 col-sm-8 col-md-6 shadow m-auto m-lg-0">
			<div class="card-header">
				{{ $message->email }}
			</div>
			<div class="card-body">
				<blockquote class="blockquote mb-0">
					<p>{{ $message->text }}</p>
					<footer class="blockquote-footer">Messaggio inviato da <cite title="Source Title">{{ $message->name }}</cite></footer>
				</blockquote>
				<a class="visualizza btn btn-light border my-3" href="{{ route('message.index') }}">Home messaggi</a>
			</div>
		</div>
	</div>

	<style>
		@media screen and (min-width:768px) {
			.w-md-100 {
				width: 100% !important;
			}
		}

		@media screen and (max-width:990px) {
			.w-md-100 {
				margin-top: 8rem !important;
			}
		}

		@media screen and (max-width:768px) {
			.w-md-100 {
				margin-top: 7rem !important;
			}
		}
	</style>
@endsection
