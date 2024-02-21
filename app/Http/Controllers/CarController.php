<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Http\Requests\CarRequest;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('home', compact('cars'));
    }

    public function spec_data(Car $car)
    {
        return view('car.spec', compact('car'));
    }

    public function car_list()
    {
        $cars = Car::all();
        return view('car.list', compact('cars'));
    }

    public function car_add()
    {
        return view('car.add');
    }

    public function car_add_store(CarRequest $request)
    {
        $car = new Car();
        $car->brand = $request->input('brand');
        $car->model = $request->input('model');
        $car->year = $request->input('year');
        $car->price = $request->input('price');

        $photos = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('public/photos');
                $photos[] = $path;
            }
        }
        $car->photos = json_encode($photos);

        $car->save();

        return redirect()->route('car.list')->with('success', 'Car added successfully');
    }

    public function car_edit($id)
    {
        $car = Car::findOrFail($id);
        return view('car.edit', compact('car'));
    }

    public function car_edit_store(CarRequest $request, $id)
    {
        $car = Car::findOrFail($id);

        $car->brand = $request->input('brand');
        $car->model = $request->input('model');
        $car->year = $request->input('year');
        $car->price = $request->input('price');

        $photos = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('public/photos');
                $photos[] = $path;
            }
            $car->photos = $photos;
        }

        $car->save();

        return redirect()->route('car.list')->with('success', 'Car updated successfully');
    }

    public function car_delete($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('car.list')->with('success', 'Car deleted successfully');
    }

    public function delete_photo($id)
    {
        $car = Car::findOrFail($id);
        
        if (!request()->has('photo_path')) {
            return response()->json(['error' => 'Nie podano ścieżki zdjęcia'], 400);
        }

        $photo_path = request('photo_path');
        $car_photos = json_decode($car->photos, true);

        $final_array = array_filter($car_photos, function($value) use ($photo_path) {
            return $value !== $photo_path;
        });

        $car->photos = $final_array;
        $car->save();

        Storage::delete($photo_path);

        return response()->json(['message' => 'Zdjęcie zostało pomyślnie usunięte'], 200);
    }
}
