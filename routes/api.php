<?php

use App\Http\Controllers\API\CarController;
use Illuminate\Support\Facades\Route;

Route::apiResource('cars', CarController::class);
