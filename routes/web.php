<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Main page
Route::get('/', [CarController::class, 'index'])->name('car.index');
Route::get('/car/{id}', [CarController::class, 'spec_data'])->name('car.spec_data');
Route::post('/car/reservate/{id}', [CarController::class, 'reservate_car'])->name('car.reservate');

//Auth
Route::get('/login', [UserController::class, 'index'])->name('login.index');
Route::post('/login', [UserController::class, 'login'])->name('login.login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//CRUD
Route::middleware('auth')->group(function () {
    Route::get('/cars_list', [CarController::class, 'car_list'])->name('car.list');
    Route::get('/add/car', [CarController::class, 'car_add'])->name('car.add');
    Route::post('/add/car', [CarController::class, 'car_add_store'])->name('car.add_store');
    Route::get('/edit/car/{id}', [CarController::class, 'car_edit'])->name('car.edit');
    Route::put('/edit/car/{id}', [CarController::class, 'car_edit_store'])->name('car.edit_store');
    Route::delete('/car/{id}', [CarController::class, 'car_delete'])->name('car.delete');
    Route::delete('/delete_photo/car/{id}', [CarController::class, 'delete_photo'])->name('car.delete_photo');


});


