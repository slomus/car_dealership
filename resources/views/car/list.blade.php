@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista pojazdów</h1>
    <a class="btn btn-success mb-3" href="{{ route('car.add') }}">Dodaj nowy</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Zdjęcie</th>
                <th>Marka</th>
                <th>Model</th>
                <th>Rok produkcji</th>
                <th>Kolor</th>
                <th>Rodzaj paliwa</th>
                <th>Pojemność</th>
                <th>Przebieg</th>
                <th>Cena</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
                <tr>
                    <td>
                        @if($car->photos)
                            @php
                                $photos_array = json_decode($car->photos, true);
                                $photo_path = !empty($photos_array) ? $photos_array[0] : null;
                            @endphp
                            @if($photo_path)
                                <img src="{{ Storage::url($photo_path) }}" alt="Car Photo" style="max-width: 100px;">
                            @else
                                Brak zdjęcia
                            @endif
                        @else
                            Brak zdjęcia
                        @endif

                    </td>
                    <td>{{ $car->brand }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->year }}</td>
                    <td>{{ $car->color }}</td>
                    <td>{{ $car->fuel_type }}</td>
                    <td>{{ $car->engine_capacity }}</td>
                    <td>{{ $car->course }}</td>
                    <td>{{ money($car->price) }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('car.edit', $car->id) }}">Edycja</a> 
                        <form action="{{ route('car.delete', $car->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Usuń</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
