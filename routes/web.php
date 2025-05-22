<?php

use App\Http\Controllers\AsignarController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('sistema.dashboard');
    })->name('dashboard');

    Route::resource('/roles', RoleController::class)->names('roles');
    Route::resource('/permisos', PermisoController::class)->names('permisos');
    Route::resource('/asignar', AsignarController::class)->names('asignar');

    Route::resource('/usuarios', UserController::class)->names('usuarios');

    Route::resource('/bitacora', BitacoraController::class)->names('bitacora');

    Route::resource('/habitaciones', HabitacionController::class)->names('habitaciones');

    Route::resource('/servicios', ServicioController::class)->names('servicios');
});
