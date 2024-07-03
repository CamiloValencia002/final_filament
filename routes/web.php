<?php

use App\Livewire\Logu;
use App\Livewire\RatePackage;
use App\Livewire\ShowPackageUser;
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
// VALIDACIÓN DE LOGIN (SI NO ESTÁ LOGEADO NO PERMTIE INGRESAR)//
Route::middleware(['auth'])->group(function () {
    Route::get('/package-user', function () {
        return view('package-user');
    })->name('package');
});
//RUTA PARA EL LOGOUT//
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login-user');
})->name('logout');

Route::get('/login', Logu::class);

Route::get('/packages', [PackageController::class, 'index'])->name('packages'); // Ruta para la vista de paquetes
Route::post('/procesar-formulario', [PackageController::class, 'store'])->name('procesar.formulario');

Route::get('register-user', function () {
    return view('register-user');
})->name('register-user');

Route::get('package-user', function () {
    return view('package-user');
})->name('package-user');

Route::get('/packages', ShowPackageUser::class)->name('packages.index');
Route::get('/packages/{packageId}/rate', RatePackage::class)->name('packages.rate');

Route::get('rate/{packageId}', function ($packageId) {
    return view('rate', ['packageId' => $packageId]);
})->name('rate');
