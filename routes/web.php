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
    })->name('dashboard');;
    //  roles
    {
        Route::resource('/roles', RoleController::class)->names('roles');
        Route::get('/roles/exportar/csv', [RoleController::class, 'csv'])->name('roles.exportar.csv');
        Route::get('/roles/exportar/pdf', [RoleController::class, 'pdf'])->name('roles.exportar.pdf');
    }

    // permisos 
    {
        Route::resource('/permisos', PermisoController::class)->names('permisos');
        Route::get('/permisos/exportar/csv', [PermisoController::class, 'csv'])->name('permisos.exportar.csv');
        Route::get('/permisos/exportar/pdf', [PermisoController::class, 'pdf'])->name('permisos.exportar.pdf');
    }

    // usuarios
    {
        Route::resource('/usuarios', UserController::class)->names('usuarios');
        Route::get('/usuarios/exportar/csv', [UserController::class, 'csv'])->name('usuarios.exportar.csv');
        Route::get('/usuarios/exportar/pdf', [UserController::class, 'pdf'])->name('usuarios.exportar.pdf');
    }

    // habitaciones
    {
        Route::resource('/habitaciones', HabitacionController::class)->names('habitaciones');
        Route::get('/habitaciones/exportar/csv', [HabitacionController::class, 'csv'])->name('habitaciones.exportar.csv');
        Route::get('/habitaciones/exportar/pdf', [HabitacionController::class, 'pdf'])->name('habitaciones.exportar.pdf');
    }

    // servicios
    {
        Route::resource('/servicios', ServicioController::class)->names('servicios');
        Route::get('/servicios/exportar/csv', [ServicioController::class, 'csv'])->name('servicios.exportar.csv');
        Route::get('/servicios/exportar/pdf', [ServicioController::class, 'pdf'])->name('servicios.exportar.pdf');
    }

    Route::resource('/asignar', AsignarController::class)->names('asignar');
    Route::resource('/bitacora', BitacoraController::class)->names('bitacora');
});
