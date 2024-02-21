<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|numeric|date_format:Y',
            'color' => 'required|string',
            'fuel_type' => 'required|string',
            'price' => 'required|numeric',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'brand.required' => 'Marka jest wymagana',
            'model.required' => 'Model jest wymagany',
            'year.required' => 'Rok jest wymagany',
            'year.numeric' => 'Rok przyjmuje tylko liczby',
            'year.date_format' => 'To nie jest rok',
            'fuel_type.required' => 'Rodzaj paliwa jest wymagany',
            'fuel_type.string' => 'Rodzja paliwa jest wymagany',
            'price.required' => 'Cena jest wymagana',
            'price.numeric' => 'Cena musi być liczbą',
            'photos.image' => 'Nie odpowiedni format',
            'photos.mimes' => 'Zdjęcie akceptuje tylko jpeg, png, jpg, gif',
            'photos.max' => 'Zdjęcie jest za duże',
        ];
    }
}