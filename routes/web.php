<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;// controlador de cliente
use App\Http\Controllers\EmpleadoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Rutas de cliente
Route::resource('clientes', ClienteController::class);
Route::get('/index', [ClienteController::class, 'index'])->name('clientes.index');

//Rutas de empleado
Route::resource('empleados', EmpleadoController::class);
Route::get('/indexempleado', [EmpleadoController::class, 'index'])->name('empleados.indexempleado');

//Rutas de solicitud
Route::resource('/solicitudes', \App\Http\Controllers\SolicitudController::class);
Route::get('/indexsolicitud', [\App\Http\Controllers\SolicitudController::class, 'index'])->name('solicitud.indexsolicitud');
