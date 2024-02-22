@extends('layouts.app')

@section('content')
 <div class="container">
        <h1>{{ $car->brand }} {{ $car->model }}</h1>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @php
                    $photos_array = json_decode($car->photos, true);
                    $i = 0;
                @endphp
                @if($photos_array)
                    @foreach($photos_array as $photo_path)
                        <div class="carousel-item {{ $i == 0 ? 'active' : ''}}">
                            <img class="carousel-img" src="{{ Storage::url($photo_path) }}" class="d-block w-100" alt="...">        
                        </div>
                    @endforeach
                @else
                    <img class="card-img-top" src="https://dummyimage.com/800x400/dee2e6/6c757d.jpg&text=Brak+zdjecia" alt="..." />
                @endif
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Poprzednie</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Następne</span>
            </a>
        </div>
        
        <div class="mt-5">
            <h2>Opis pojazdu</h2>
            <p>
                Marka: {{ $car->brank }} </br>console.assert(first, second)
                Model: {{ $car->model }} </br>
                Cena: {{ money($car->price) }} </br>
                Rok: {{ $car->year }} </br>
                Przebieg: {{ $car->course }} km </br>
                Paliwo: {{ $car->fuel_type }} </br>
                Kolor: {{ $car->color }} </br>
            </p>
            <h5>Zainteresowany zakupem? Zadzwoń do nas:</h5>
            <p>Numer telefonu: +48 123 456 789</p>
            <button id="reservation_button" class="btn btn-primary {{ $car->reservation == 0 ? '' : 'disabled' }}" onclick="{{ $car->reservation == 0 ? 'reservate_car()' : '' }}">{{ $car->reservation == 0 ? 'Zarezerwuj' : 'Zarezerwowany' }}</button>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script>
    function reservate_car() {
        $.ajax({
            url: "{{ route('car.reservate', $car->id) }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                console.log(response.message);
                $('#reservation_button').attr('disabled', true);
                $('#reservation_button').text('Zarezerwowany');
            },
            error: function(xhr){
                console.log('Błąd podczas rezerwacji pojazdu:', xhr.responseText);
            }
        })
    }
</script>
@endsection

