<?php

use App\Livewire\Logu;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;

Route::get('/', function () {
    return view('index');
});

Route::get('/inicioUser', function () {
    return view('layouts.app');
})->name('inicioUser');

Route::get('login-user', function () {
    return view('login-user');
})->name('login-user');

Route::get('/login', Logu::class);

Route::get('/packages', [PackageController::class, 'index'])->name('packages'); // Ruta para la vista de paquetes
Route::post('/procesar-formulario', [PackageController::class, 'store'])->name('procesar.formulario');


Route::get('/packages', [PackageController::class, 'index'])->name('packages'); // Ruta para la vista de paquetes
Route::post('/procesar-formulario', [PackageController::class, 'store'])->name('procesar.formulario');

Route::get('register-user', function () {
    return view('register-user');
})->name('register-user');

Route::get('/test-log', function() {
    Log::info('Este es un log de prueba.');
    return 'Revisa el log';
});


