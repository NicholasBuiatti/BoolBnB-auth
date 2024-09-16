@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background: linear-gradient(130deg, #ffd489a4, #8cd7f298) !important;">
                        {{ __('Registrati') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" id="registrationForm">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="surname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text"
                                        class="form-control @error('surname') is-invalid @enderror" name="surname"
                                        value="{{ old('surname') }}" autocomplete="surname" autofocus>

                                    @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="birth_date"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Data di nascita') }}*</label>

                                <div class="col-md-6">
                                    <input id="birth_date" type="date" required
                                        class="form-control @error('birth_date') is-invalid @enderror" name="birth_date"
                                        max={{ now()->subYears(18) }} value="{{ old('birth_date') }}"
                                        autocomplete="birth_date" autofocus>

                                    @error('birth_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"
                                    required>{{ __('Indirizzo mail') }}*</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    <p id="errorMail" class="text-danger"></p>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"
                                    required>{{ __('Password') }}*</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    <p id="message" class="error text-danger"></p>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right"
                                    required>{{ __('Conferma Password') }}*</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>


                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a class="btn btn-secondary" href="{{ route('login') }}">Indietro</a>
                                    <button type="submit" class="btn btn-primary" id='btnSend'>
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <p class="text-danger">I campi contrassegnati con * sono obbligatori</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        //controllo password identiche
        const formRegister = document.getElementById('registrationForm');
        formRegister.addEventListener('submit', function(event) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password-confirm').value;
            const messageElement = document.getElementById('message');

            if (password !== confirmPassword) {
                //prevengo il submit prima dell'invio
                event.preventDefault();
                messageElement.textContent = 'Le password non corrispondono.';
            } else {
                messageElement.textContent = '';
            }
            let mail = document.getElementById('email').value;

            const regex = new RegExp(
                '^[^\\s@]+@[^\\s@]+\\.(com|org|net|edu|gov|co|io|us|uk|de|jp|fr|it|ru|br|ca|cn|au|in|es)$');
            if (!regex.test(mail)) {
                //console.log("L'email è valida.");
                //console.log("L'email non è valida.");
                event.preventDefault();
                document.getElementById('errorMail').textContent = "l'email non è valida";

            }
            /*else if(mail==null) {
    				document.getElementById('errorMail').textContent="";
    			}*/


        });
    </script>
@endsection
