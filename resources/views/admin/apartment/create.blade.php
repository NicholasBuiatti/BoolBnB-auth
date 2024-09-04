@extends('layouts.navBar')

@section('content')
    <div class="d-flex align-items-start w-100">
        <form id="apartmentForm" method="POST" action="{{ route('apartments.store') }}" class="w-100 p-5"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Descrizione appartamento </label>
                <input type="text" class="form-control" name="title" required value="{{ old('title') }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Camere</label>
                <input type="number" min="1" class="form-control" name="rooms" required
                    value="{{ old('rooms') }}">
                @error('rooms')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Letti</label>
                <input type="number" min="1" class="form-control" name="beds" required
                    value="{{ old('beds') }}">
                @error('beds')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Bagni </label>
                <input type="number" min="1" class="form-control" name="bathrooms" required
                    value="{{ old('bathrooms') }}">
                @error('bathrooms')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Dimensioni</label>
                <input type="number" min="1" class="form-control" name="dimension_mq" placeholder="in metri quadri"
                    required value="{{ old('dimension_mq') }}">
                @error('dimension_mq')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Inserisci Immagine</label>
                <input type="file" accept="image/*" id="image" class="form-control" name="image" placeholder=""
                    required>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <p id="fileSizeError" style="color:red; display:none;">Il file supera le dimensioni massime di 5 mb.</p>

            </div>
            <div class="mb-3">
                <label class="form-label">Indirizzo </label>
                <input id="input_indirizzo" type="text" class="form-control" name="address_full"
                    placeholder="inserisci numero per tipo progetto" required value="{{ old('address_full') }}"
                    list="opzioni">
                <ul id="opzioni">
                </ul>
                @error('address_full')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <p id="addressError" style="color:red; display:none;">L'indirizzo non è valido</p>
            </div>
            <button type="submit" class="btn btn-primary" id='btnSend'>Inserisci Appartamento </button>
        </form>
    </div>

    {{-- <script>
        document.getElementById('image').addEventListener('change', function() {
            let file = this.files[0];
            if (file.size > 5 * 1024 * 1024) {
                document.getElementById('fileSizeError').style.display = 'block';
                // disabilito l'invio del form se il file è troppo grande
                document.getElementById('apartmentForm').onsubmit = function(event) {
                    event.preventDefault();
                }
            } else {
                document.getElementById('fileSizeError').style.display = 'none';
                // permetto l'invio del form se il file rispetta le dimensioni
                document.getElementById('apartmentForm').onsubmit = function(event) {
                    return true;
                };
            }

        });
<<<<<<< HEAD


=======
        
>>>>>>> branch-api
        let apiAnswer = [];
        const apiKey = "RUfkTtEK0CYbHBG3YE2RSEslSRGAWZcu";
        const limit = 5;
        let indirizzo = document.getElementById('input_indirizzo');
        let selectedAddress = '';
        indirizzo.addEventListener('input', function() {
            if (indirizzo.value.length > 5) {
                let addressInput = indirizzo.value;
                const url_tomtom =
                    `https://api.tomtom.com/search/2/search/${encodeURIComponent(addressInput)}.json?key=${apiKey}&typeahead=true&limit=${limit}&countrySet={IT}`;
                axios.get(url_tomtom)
                    .then(function(response) {
<<<<<<< HEAD

                        apiAnswer = response.data;

                        console.log(apiAnswer);

                        let lista = document.getElementById('opzioni');
                        lista.innerHTML = '';

=======
                        apiAnswer = response.data;
                        console.log(apiAnswer);
                        let lista = document.getElementById('opzioni');
                        lista.innerHTML = '';
>>>>>>> branch-api
                        for (let i = 0; i < apiAnswer.results.length; i++) {
                            let indirizzoCompleto = apiAnswer.results[i].address.freeformAddress;
                            let newOption = document.createElement("li");
                            newOption.innerHTML = indirizzoCompleto;
<<<<<<< HEAD

=======
>>>>>>> branch-api
                            newOption.addEventListener('click', function() {
                                indirizzo.value = indirizzoCompleto;
                                selectedAddress = indirizzoCompleto;
                                apiAnswer = [];
                                lista.innerHTML = '';
<<<<<<< HEAD

                                console.log("Indirizzo selezionato:", selectedAddress);
                            });

=======
                                console.log("Indirizzo selezionato:", selectedAddress);
                            });
>>>>>>> branch-api
                            lista.append(newOption);
                        }
                    });
            }
        })
<<<<<<< HEAD


        document.getElementById('btnSend').addEventListener('click', function() {
            if (selectedAddress == indirizzo.value) {
                console.log("l'indirizzo è uguale")
                document.getElementById('addressError').style.display = 'none';
                document.getElementById('apartmentForm').onsubmit = function(event) {
                    return true;
                };
            } else {
                console.log("l'indirizzo NON è uguale")
                document.getElementById('apartmentForm').onsubmit = function(event) {
                    event.preventDefault();
                }
                document.getElementById('addressError').style.display = 'block';
            }
        });
    </script> --}}
    <style>
        #opzioni {
            width: 100%;
            background-color: rgb(216, 216, 216);
            border-radius: 10px;
            max-height: 4.5rem;
            overflow: auto;
            padding-left: 0;
        }

        #opzioni li {
            list-style: none;
            cursor: pointer;
            width: 100%;
            padding-left: 1rem;
        }

        #opzioni li:hover {
            background-color: rgba(0, 145, 255, 0.278);
            transition: .5s;
        }
    </style>
=======
    </script>
>>>>>>> branch-api
@endsection
