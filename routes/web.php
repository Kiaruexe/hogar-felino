<?php

use App\Http\Controllers\AdminCasaController;
use App\Http\Controllers\AdminGatoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\listaGatoController;
use App\Http\Controllers\MensajeContactoController;
use App\Http\Controllers\RegistroGatoController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/registro', [AuthController::class, 'index'])->name('index');

Route::post('/registro', [AuthController::class, 'registro'])->name('registro');

Route::get('/login', [AuthController ::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/', [listaGatoController::class, 'home'])->name('gatos.index');

Route::get('/gatos', [listaGatoController::class, 'index'])->name('gatos.lista');


Route::get('/gatos/{id}', [listaGatoController::class, 'mostrar'])->name('gatos.mostrar');

Route::get('/contactar/{gato}', [MensajeContactoController::class, 'crear'])->name('contacto.crear');

Route::post('/contactar/{gato}', [MensajeContactoController::class, 'enviar'])->name('contacto.enviar');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout.casa');

Route::group(['middleware' => 'auth'], function () {

Route::get('/casa', [listaGatoController::class, 'casa'])->name('casa');

Route::get('/registro-gato', [RegistroGatoController::class, 'index'])->name('gatos.registro');

Route::post('/registro-gato', [RegistroGatoController::class, 'registro'])->name('gato.registro');

// Ruta para mostrar la lista de gatos
Route::get('/lista-gatos', [listaGatoController::class, 'index'])->name('gatos.lista');

// Ruta para mostrar el formulario de edición de un gato específico
Route::get('/gatos/{id}/editar', [listaGatoController::class, 'edit'])->name('gatos.edit');

// Ruta para actualizar un gato (usamos método PUT)
Route::put('/gatos/{id}', [listaGatoController::class, 'update'])->name('gatos.update');

Route::delete('/gatos/{id}', [listaGatoController::class, 'destroy'])->name('gatos.destroy');




Route::get('/mensajes/recibidos', [MensajeContactoController::class, 'verParaCasa'])->name('contacto.recibidos');


});





Route::middleware([AdminMiddleware::class])->group(function () {

    Route::get('/admin', [AdminCasaController::class, 'indexAdmin'])->name('admin.index');


    Route::get('/gatosAdmin', [AdminGatoController::class, 'index'])->name('admin.gatos.index');
    Route::get('/gatosAdmin/{id}', [AdminGatoController::class, 'show'])->name('admin.gatos.show');
    Route::get('/gatosAdmin/{id}/editar', [AdminGatoController::class, 'edit'])->name('admin.gatos.edit');
    Route::put('/gatosAdmin/{id}', [AdminGatoController::class, 'update'])->name('admin.gatos.update');
    Route::delete('/gatosAdmin/{id}', [AdminGatoController::class, 'destroy'])->name('admin.gatos.destroy');


    Route::get('/casasAdmin', [AdminCasaController::class, 'index'])->name('admin.casas.index');
    Route::get('/casasAdmin/{id}', [AdminCasaController::class, 'show'])->name('admin.casas.show');
    Route::get('/casasAdmin/{id}/editar', [AdminCasaController::class, 'edit'])->name('admin.casas.edit');
    Route::put('/casasAdmin/{id}', [AdminCasaController::class, 'update'])->name('admin.casas.update');
    Route::delete('/casasAdmin/{id}', [AdminCasaController::class, 'destroy'])->name('admin.casas.destroy');
    
});

