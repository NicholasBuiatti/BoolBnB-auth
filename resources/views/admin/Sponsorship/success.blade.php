@extends('layouts.app')

@section('content')
	<div class="container mt-5">

		<div class="card m-auto col-12 col-md-6 shadow" style="background: rgb(251, 238, 238)">
			<h2 class="card-title mt-5 mb-3 text-center">Grazie per la sponsorizzazione!</h2>
			<div class="card-body text-center">
				<p class="card-text">Il pagamento è andato a buon fine! Grazie per aver scelto di sponsorizzare il tuo appartamento
					sul nostro sito. Il tuo contributo ci permette di darti maggiore visibilità e di mettere in evidenza la tua offerta.
					Siamo certi che questa sponsorizzazione ti aiuterà a raggiungere un pubblico più ampio e a trovare velocemente nuovi
					inquilini o acquirenti. Ti auguriamo il meglio per la tua inserzione e rimaniamo a disposizione per qualsiasi
					domanda o
					assistenza. Grazie ancora per la fiducia!
				</p>
				<div class="text-start">
					<a class="btn btnmy rounded-circle" href="{{ route('apartments.index') }}"><i class="fa-solid fa-arrow-left"></i>
						Home</a>
				</div>
			</div>
		</div>


	</div>

	<style>
		.btnmy:hover {
			text-decoration: underline;
		}

		.btnmy i {
			margin-right: 5px;
		}
	</style>
@endsection
