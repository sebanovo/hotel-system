<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\AsignarController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\NotaVentaController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\PisoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\TipoPagoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/link', function () {
    Artisan::call('storage:link');
    return back()->with('success', 'Storage link created successfully.');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [PanelController::class, 'index'])->name('dashboard');
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

        Route::put('/usuarios/photo/{id}', [UserController::class, 'updatePhoto'])->name('usuarios.updatePhoto');

        Route::get('/perfil/{id}', [UserController::class, 'show'])->name('profile.show');
        Route::put('/perfil/{id}/cambiar-password', [UserController::class, 'cambiarPassword'])->name('usuarios.cambiarPassword');
    }

    // habitaciones
    {
        Route::resource('/habitaciones', HabitacionController::class)->names('habitaciones');
        Route::get('/habitaciones/exportar/csv', [HabitacionController::class, 'csv'])->name('habitaciones.exportar.csv');
        Route::get('/habitaciones/exportar/pdf', [HabitacionController::class, 'pdf'])->name('habitaciones.exportar.pdf');

        Route::put('/habitaciones/foto/{id}', [HabitacionController::class, 'updatePhoto'])->name('habitaciones.updatePhoto');
        Route::get('/habitaciones/reservar/{id}', [HabitacionController::class, 'showHabitacion'])->name('showHabitacion');
    }

    // articulos
    {
        Route::resource('/articulos', ArticuloController::class)->names('articulos');
        Route::get('/articulos/exportar/csv', [ArticuloController::class, 'csv'])->name('articulos.exportar.csv');
        Route::get('/articulos/exportar/pdf', [ArticuloController::class, 'pdf'])->name('articulos.exportar.pdf');
    }

    // pisos 
    {
        Route::resource('/pisos', PisoController::class)->names('pisos');
        Route::get('/pisos/exportar/csv', [PisoController::class, 'csv'])->name('pisos.exportar.csv');
        Route::get('/pisos/exportar/pdf', [PisoController::class, 'pdf'])->name('pisos.exportar.pdf');
    }

    // reservas 
    {
        Route::resource('/reservas', ReservaController::class)->names('reservas');
        Route::get('/reservas/exportar/csv', [ReservaController::class, 'csv'])->name('reservas.exportar.csv');
        Route::get('/reservas/exportar/pdf', [ReservaController::class, 'pdf'])->name('reservas.exportar.pdf');

        Route::post('/reservas/reservar-habitacion/', [ReservaController::class, 'reservarHabitacion'])->name('reservarHabitacion');
    }

    // servicios
    {
        Route::resource('/servicios', ServicioController::class)->names('servicios');
        Route::get('/servicios/exportar/csv', [ServicioController::class, 'csv'])->name('servicios.exportar.csv');
        Route::get('/servicios/exportar/pdf', [ServicioController::class, 'pdf'])->name('servicios.exportar.pdf');

        Route::get('/servicios/comprar/{id}', [ServicioController::class, 'showServicio'])->name('showServicio');
        Route::post('/servicios/comprar/{id}', [ServicioController::class, 'comprarServicio'])->name('comprarServicio');

        Route::post('/servicios/asignar/', [ServicioController::class, 'asignarServicio'])->name('servicios.asignar');
    }

    // nota venta
    {
        Route::resource('/notaventa', NotaVentaController::class)->names('notaventas');
        Route::get('/notaventa/exportar/csv', [NotaVentaController::class, 'csv'])->name('notaventas.exportar.csv');
        Route::get('/notaventa/exportar/pdf', [NotaVentaController::class, 'pdf'])->name('notaventas.exportar.pdf');
    }

    // tipo pago 
    {
        Route::resource('/tipo_pago', TipoPagoController::class)->names('tipo_pagos');
        Route::get('/tipo_pago/exportar/csv', [TipoPagoController::class, 'csv'])->name('tipo_pagos.exportar.csv');
        Route::get('/tipo_pago/exportar/pdf', [TipoPagoController::class, 'pdf'])->name('tipo_pagos.exportar.pdf');
    }

    // bitacora
    {
        Route::resource('/bitacora', BitacoraController::class)->names('bitacora');
        Route::get('/bitacora/exportar/csv', [BitacoraController::class, 'csv'])->name('bitacora.exportar.csv');
        Route::get('/bitacora/exportar/pdf', [BitacoraController::class, 'pdf'])->name('bitacora.exportar.pdf');
    }

    // clientes
    {
        Route::resource('/clientes', ClienteController::class)->names('clientes');
        Route::get('/clientes/exportar/csv', [ClienteController::class, 'csv'])->name('clientes.exportar.csv');
        Route::get('/clientes/exportar/pdf', [ClienteController::class, 'pdf'])->name('clientes.exportar.pdf');
    }

    // reporte
    {
        Route::resource('/reportes', ReporteController::class)->names('reportes');
        Route::get('/reportes/reservas/exportar', [ReporteController::class, 'reservasExportar'])->name('reportes.reservas.exportar');
        Route::get('/reportes/habitaciones/exportar', [ReporteController::class, 'habitacionesExportar'])->name('reportes.habitaciones.exportar');
        Route::get('/reportes/notaventas/exportar', [ReporteController::class, 'notaVentasExportar'])->name('reportes.notaventas.exportar');
    }

    // Entrada y salidasAdd commentMore actions
    {
        // Entrada
        Route::resource('/entradas', EntradaController::class)->names('entradas');
        Route::get('/entradas/checkin/{habitacion}', [EntradaController::class, 'checkin'])->name('entradas.checkin');
        // salida
        Route::resource('/salidas', SalidaController::class)->names('salidas');
        Route::get('/salidas/{habitacion}/checkout', [SalidaController::class, 'checkout'])->name('salidas.checkout');
    }
    Route::resource('/asignar', AsignarController::class)->names('asignar');
});
