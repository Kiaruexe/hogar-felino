<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroGatoController;
use Illuminate\Support\Facades\Route;

Route::get('/registro', [AuthController::class, 'index'])->name('index');

Route::post('/registro', [AuthController::class, 'registro'])->name('registro');

Route::get('/login', [AuthController ::class, 'showLogin'])->name('login.casa');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout.casa');

Route::view ('/casa', 'casa')->middleware('auth')->name('casa');

Route::get('/registro-gato', [RegistroGatoController::class, 'index'])->name('gatos.registro');

// Ruta para procesar el registro del gato
Route::post('/registro-gato', [RegistroGatoController::class, 'registro'])->name('gato.registro');