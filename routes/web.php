<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::get('/', function () {
    return view('welcome');
});

// Client Routes
Route::resource('clients', ClientController::class);
