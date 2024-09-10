@extends('layouts.navBar')

@section('content')
	<div class="d-flex justify-content-center col">

		<div class="d-flex flex-wrap">
			<div id="card-container" class="card col">
		
				<div class="card-body ">
					<h2 class="card-title">{{ $message->name }}</h2>
					<p class="card-text">
					<p> email: {{ $message->email }}</p>
					<p class="border border-1 border-info"> messaggio completo: {{ $message->text }}</p>
					<div class="text-center">
						<a class="btn btn-primary my-2" href="{{ route('message.index') }}">Indietro</a>
                    </div>
				</div>

			</div>
		</div>
	</div>
@endsection
