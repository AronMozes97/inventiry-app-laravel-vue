<?php

use App\Http\Controllers\API\CarController;
use App\Http\Controllers\API\PartController;
use Illuminate\Support\Facades\Route;

Route::apiResource('cars', CarController::class);

Route::post('cars/{car}/archive', [CarController::class, 'archive'])->name('cars.archive');
Route::delete('car/part/{id}/remove', [CarController::class, 'removePart'])->name('cars.parts.remove');
Route::get('/cars/get/archive', [CarController::class, 'getArchivedCars'])->name('cars.get.archive');
Route::post('/cars/{id}/revoke', [CarController::class, 'revokeCar'])->name('cars.get.archive');
Route::post('/car/{carId}/part/{partID}/connect', [CarController::class, 'addPartToCar'])->name('cars.parts.connect');

Route::apiResource('parts', PartController::class);
Route::get('/parts/get/withoutCar', [PartController::class, 'getPartsWithoutCar'])->name('parts.get.withoutCar');
