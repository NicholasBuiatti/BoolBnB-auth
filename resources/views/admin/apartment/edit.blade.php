@extends('layouts.navBar')

@section('content')
    <div class="d-flex align-items-start">

        <div class="h-100 w-100 overflow-auto">
            <form id="apartmentForm" method="POST" action="{{ route('apartments.update', $apartment) }}" class="p-5"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Descrizione appartamento </label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') ?? $apartment->title }}"
                        required>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Camere</label>
                    <input type="text" class="form-control" min="0" name="rooms"
                        value={{ old('rooms') ?? $apartment->rooms }} required>
                    @error('rooms')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Letti</label>
                    <input type="number" class="form-control" min="0" name="beds"
                        value={{ old('beds') ?? $apartment->beds }} required>
                    @error('beds')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Bagni </label>
                    <input type="number" class="form-control" min="0" name="bathrooms"
                        value={{ old('bathrooms') ?? $apartment->bathrooms }} required>
                    @error('bathrooms')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Dimensioni</label>
                    <input type="number" min="0" class="form-control" placeholder="in metri quadri"
                        name="dimension_mq" value={{ old('dimension_mq') ?? $apartment->dimension_mq }} required>
                    @error('dimension_mq')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Inserisci Immagine</label>
                    <input id="image" type="file" accept="image/*" class="form-control" name="image"
                        value={{ old('image') ?? $apartment->image }} >
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <p id="fileSizeError" style="color:red; display:none;">Il file supera le dimensioni massime di 5 mb.</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Indirizzo </label>
                    <input id="input_indirizzo" type="text" class="form-control" name="address_full"
                         required value="{{ old('address_full') ?? $apartment->address_full }}"
                        list="opzioni">
                    <ul id="opzioni">
                    </ul>
                    @error('address_full')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <p id="addressError" style="color:red; display:none;">L'indirizzo non è valido</p>
                </div>
                <div class="mb-3">
                    <label class="form-label me-2">Visibilità Appartamento  </label>
                    <input type="checkbox" class=""  name="is_visible"
                        {{ $apartment['is_visible'] ? 'checked': 'unchecked' }} >
                    @error('is_visible')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

    
                <button type="submit" class="btn btn-primary">Modifica appartamento </button>
                
            </form>
            {{-- delete button --}}
            <form class="px-5 pb-5" action="{{ route('apartments.destroy', $apartment) }}" method="POST">
                @csrf
                @method('DELETE')
                <button id="bottone" class="btn btn-danger" type="submit">Elimina l'appartamento dalla tua lista
                </button>
            </form>
        </div>
    </div>
    <script>
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

                        apiAnswer = response.data;

                        console.log(apiAnswer);

                        let lista = document.getElementById('opzioni');
                        lista.innerHTML = '';

                        for (let i = 0; i < apiAnswer.results.length; i++) {
                            let indirizzoCompleto = apiAnswer.results[i].address.freeformAddress;
                            let newOption = document.createElement("li");
                            newOption.innerHTML = indirizzoCompleto;

                            newOption.addEventListener('click', function() {
                                indirizzo.value = indirizzoCompleto;
                                selectedAddress = indirizzoCompleto;
                                apiAnswer = [];
                                lista.innerHTML = '';

                                console.log("Indirizzo selezionato:", selectedAddress);
                            });

                            lista.append(newOption);
                        }
                    });
            }
        })


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
    </script>
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
    
@endsection
