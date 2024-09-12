@extends('layouts.navBar')

@section('content')
    <div class="d-flex align-items-start">

        <div class="d-flex align-items-start w-100" style="max-width: 1000px">
            <form id="apartmentForm" method="POST" action="{{ route('apartments.update', $apartment) }}" class="w-100 p-3 row"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3 col-md-5">
                    <label class="form-label">Nome Appartamento</label>
                    <input type="text" class="form-control" name="title"
                        value="{{ old('title') ?? $apartment->title }}" required>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-5">
                    <label class="form-label">Indirizzo</label>
                    <input id="input_indirizzo" type="text" class="form-control" name="address_full" required
                        value="{{ old('address_full') ?? $apartment->address_full }}" list="opzioni">
                    <ul id="opzioni">
                    </ul>
                    @error('address_full')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <p id="addressError" style="color:red; display:none;">L'indirizzo non è valido</p>
                </div>


                <div class="row justify-content-between col-6 col-lg-7">
                    <div class="row justify_content_around">
                        <div class="mb-4 col-12 col-sm-8 col-lg-5">
                            <label for="rooms" class="form-label fw-bold">Camere</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="bi bi-door-closed"></i>
                                </span>
                                <input type="number" id="rooms" min="1"
                                    class="form-control @error('rooms') is-invalid @enderror" name="rooms"
                                    value={{ old('rooms') ?? $apartment->rooms }} required>
                            </div>
                            @error('rooms')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-12 col-sm-8 col-lg-5">
                            <label for="beds" class="form-label fw-bold">Letti</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fa-solid fa-bed"></i></i>
                                </span>
                                <input type="number" id="beds" min="1"
                                    class="form-control @error('beds') is-invalid @enderror" name="beds"
                                    value={{ old('beds') ?? $apartment->beds }} required>
                            </div>
                            @error('beds')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-12 col-sm-8 col-lg-5">
                            <label for="bathrooms" class="form-label fw-bold">Bagni</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="bi bi-droplet"></i>
                                </span>
                                <input type="number" id="bathrooms" min="1"
                                    class="form-control @error('bathrooms') is-invalid @enderror" name="bathrooms"
                                    value={{ old('bathrooms') ?? $apartment->bathrooms }} required>
                            </div>
                            @error('bathrooms')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-12 col-sm-8 col-lg-5">
                            <label for="dimension_mq" class="form-label fw-bold">Dimensioni (Mq)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="bi bi-rulers"></i>
                                </span>
                                <input type="number" id="dimension_mq" min="1"
                                    class="form-control @error('dimension_mq') is-invalid @enderror" name="dimension_mq"
                                    value={{ old('dimension_mq') ?? $apartment->dimension_mq }} required>
                            </div>
                            @error('dimension_mq')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                </div>

                <div class="mb-4 flex-column col-5">
                    <label for="services" class="col-md-2 col-form-label text-md-right">
                        <p class="mb-0">Servizi:</p>
                    </label>
                    <div class="col-md-10">
                        @foreach ($services as $service)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="services[]"
                                    value="{{ $service->id }}" id="service{{ $service->id }}"
                                    @checked(in_array($service->id, old('services', $relations)))>
                                <label class="form-check-label" for="service{{ $service->id }}">
                                    {{ $service->name }}
                                </label>
                            </div>
                        @endforeach
                        @error('services')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 col-12 col-sm-8">
                    <label class="form-label">Inserisci Immagine</label>
                    <input id="image" type="file" accept="image/*" class="form-control" name="image"
                        value={{ old('image') ?? $apartment->image }}>
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <p id="fileSizeError" style="color:red; display:none;">Il file supera le dimensioni massime di 5 mb.
                    </p>
                </div>

                <div class="mb-3">
                    <label class="form-label me-2">Visibilità Appartamento </label>
                    <input type="checkbox" class="" name="is_visible"
                        {{ $apartment['is_visible'] ? 'checked' : 'unchecked' }}>
                    @error('is_visible')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary col-5 col-md-3">Modifica appartamento </button>

            </form>
        </div>
    </div>

    <style>
        main {
            position: relative;
            background-color: #e9e9e9;
            background-image: url('/back.png');
            background-repeat: no-repeat;
            background-size: 80%;
            background-position: bottom right;
            background-size: 40vw;
            z-index: 1;
        }

        main::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
        }

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

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            /* Firefox */
            appearance: textfield;
            /* Altri browser */
        }
    </style>
@endsection
