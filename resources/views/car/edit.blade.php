@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('car.edit_store', $car->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="brand" class="form-label">Marka</label>
            <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand" name="brand" value="{{ old('brand', $car->brand) }}">
            @error('brand')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" value="{{ old('model', $car->model) }}">
            @error('model')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Rok produkcji</label>
            <input type="text" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year', $car->year) }}">
            @error('year')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Kolor</label>
            <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color', $car->color) }}">
            @error('color')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="fuel_type" class="form-label">Rodzaj paliwa</label>
            <select class="form-select @error('fuel_type') is-invalid @enderror" id="fuel_type" name="fuel_type">
                <option value="">Wybierz rodzaj</option>
                <option value="Disel" {{ old('fuel_type', $car->fuel_type) === 'Disel' ? 'selected' : '' }}>Disel</option>
                <option value="Benzyna" {{ old('fuel_type', $car->fuel_type) === 'Benzyna' ? 'selected' : '' }}>Benzyna</option>
            </select>
            @error('fuel_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Cena</label>
            <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $car->price) }}">
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="photos" class="form-label">Zdjęcia</label>
            <input type="file" class="form-control @error('photos') is-invalid @enderror" id="photos" name="photos[]" multiple>
            @error('photos')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="current_photos" class="form-label">Aktualne zdjęcia</label>
            <div class="row">
                @php 
                    $photos_array = json_decode($car->photos, true);
                    $i = 0;
                @endphp
                @foreach($photos_array as $photo_path)
                    <div class="col-2 mb-2" id="photo_div_{{ $i }}">
                        <img src="{{ Storage::url($photo_path) }}" alt="Car Photo" class="img-thumbnail">
                        <button type="button" class="btn btn-sm btn-danger mt-1" onclick="delete_photo('{{ $photo_path }}',{{ $i }})">Usuń</button>
                    </div>
                    @php
                    $i++;
                    @endphp
                @endforeach
            </div>
        </div>
        
        <button class="btn btn-success" type="submit">Zapisz</button>
        <a class="btn btn-danger" href="{{ route('car.list') }}">Anuluj</a>
    </form>
</div>

<script>
    function delete_photo(photo_path_data,i) {
        if (confirm('Czy na pewno chcesz usunąć to zdjęcie?')) {
            $.ajax({
                url: "{{ route('car.delete_photo', $car->id) }}",
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                    photo_path: photo_path_data
                },
                success: function(response) {
                    console.log(response.message);
                    $('#photo_div_'+ i).hide();
                },
                error: function(xhr) {
                    console.log('Błąd podczas usuwania zdjęcia:', xhr.responseText);
                }
            });
        }
    }
</script>


@endsection
