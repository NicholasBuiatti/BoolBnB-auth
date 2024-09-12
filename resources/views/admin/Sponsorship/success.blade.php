@extends('layouts.app')

@section('content')
	<div class="container mt-5">

		<div class="card m-auto col-12 col-md-6 shadowMy"
			style="background-image: url('{{ asset('paper.jpg') }}'); background-size: cover;">
			<div class="card-body text-center">
				<!-- Immagine rimpicciolita e posizionata in alto a sinistra -->
				<img src="/newlogo.png" alt="" style="width: 80px; height: 35px; position: absolute; top: 10px; right: 10px;">

				<h2 class="card-title mt-5 mb-3">Grazie per la sponsorizzazione!</h2>
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
		.shadowMy {
			box-shadow: 10px 10px 10px 5px;
			border-radius: 10px;
		}

		.btnmy {
			color: black;
			border: none;
			padding: 10px 20px;
			font-size: 16px;
			transition: background-color 0.3s ease;
		}

		.btnmy:hover {
			text-decoration: underline;
		}

		.btnmy i {
			margin-right: 5px;
		}
	</style>
@endsection
