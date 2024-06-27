<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;

Route::get('/', function () {
    return view('index');
});

Route::get('/inicioUser', function () {
    return view('layouts.app');
});

Route::get('login-user', function () {
    return view('login-user');
})->name('login-user');

<<<<<<< HEAD
Route::get('/packages', [PackageController::class, 'index'])->name('packages'); // Ruta para la vista de paquetes
Route::post('/procesar-formulario', [PackageController::class, 'store'])->name('procesar.formulario');
=======
Route::get('register-user', function () {
    return view('register-user');
})->name('register-user');

>>>>>>> aab255039f3cedb3a2feca9d7c6ed9ee14007069

