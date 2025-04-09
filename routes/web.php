<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\listaGatoController;
use App\Http\Controllers\RegistroGatoController;
use Illuminate\Support\Facades\Route;

Route::get('/registro', [AuthController::class, 'index'])->name('index');

Route::post('/registro', [AuthController::class, 'registro'])->name('registro');

Route::get('/login', [AuthController ::class, 'showLogin'])->name('login.casa');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/', [listaGatoController::class, 'home'])->name('gatos.index');

Route::get('/gatos', [listaGatoController::class, 'index'])->name('gatos.lista');

Route::get('/gatos/{id}', [listaGatoController::class, 'mostrar'])->name('gatos.mostrar');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout.casa');

Route::group(['middleware' => 'auth'], function () {

Route::view ('/casa', 'casa')->name('casa');

Route::get('/registro-gato', [RegistroGatoController::class, 'index'])->name('gatos.registro');

Route::post('/registro-gato', [RegistroGatoController::class, 'registro'])->name('gato.registro');

});