<?php

use App\Livewire\Logu;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;

Route::get('/', function () {
    return view('index');
});



Route::get('login-user', function () {
    return view('login-user');
})->name('login-user');

// VALIDACIÓN DE LOGIN (SI NO ESTÁ LOGEADO NO PERMTIE INGRESAR)//
Route::middleware(['auth'])->group(function () {
    Route::get('/inicioUser', function () {
        return view('layouts.app');
    })->name('inicioUser');
});
//RUTA PARA EL LOGOUT//
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login-user');
})->name('logout');

Route::get('/login', Logu::class);

Route::get('/packages', [PackageController::class, 'index'])->name('packages'); // Ruta para la vista de paquetes
Route::post('/procesar-formulario', [PackageController::class, 'store'])->name('procesar.formulario');


Route::get('/packages', [PackageController::class, 'index'])->name('packages'); // Ruta para la vista de paquetes
Route::post('/procesar-formulario', [PackageController::class, 'store'])->name('procesar.formulario');

Route::get('register-user', function () {
    return view('register-user');
})->name('register-user');




