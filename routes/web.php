<?php

use App\Http\Controllers\CityIndexController;
use App\Http\Controllers\CityShowController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/cities'));
Route::get('/cities', CityIndexController::class)->name('cities.index');
Route::get('/cities/{city}', CityShowController::class)->name('cities.show');
