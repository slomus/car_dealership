@extends('layouts.app')
@section('content')
@include('layouts.header')
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center">
                    @foreach($cars as $car)
                        <div class="col-md-4 mb-5">
                            <div class="card h-100">
                                @if($car->reservation)
                                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Rezerwacja</div>
                                @endif
                                @if($car->photos)
                                    @php
                                        $photos_array = json_decode($car->photos, true);
                                        $photo_path = !empty($photos_array) ? $photos_array[0] : null;
                                    @endphp
                                    @if($photo_path)
                                        <img class="card-img-top" src="{{ Storage::url($photo_path) }}" alt="..." />
                                    @else
                                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg&text=Brak+zdjecia" alt="..." />
                                    @endif
                                @else
                                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg&text=Brak+zdjecia" alt="..." />
                                @endif
                                
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <h5>{{ $car->brand }} {{ $car->model }}</h5>
                                        <h6>Rok: {{ $car->year }} </br> Przebieg: {{ $car->course }} km </br> Paliwo: {{ $car->fuel_type }} </br> Kolor: {{ $car->color }}</h6>
                                    </div>
                                </div>
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route('car.spec_data', $car->id) }}">Zobacz</a></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </section>

@endsection
