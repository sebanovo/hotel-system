<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Habitacion;
use App\Models\NotaVenta;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Reservar Habitacion')->only(
            ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'csv', 'pdf']
        );
        $this->middleware('can:Solicitar servicio')->only(
            ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'csv', 'pdf']
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $usuario = Auth::user();
        if ($usuario->hasRole('Administrador') || $usuario->hasRole('Recepcionista')) {
            return view(
                'sistema.dashboard',
                [
                    'habitacionesCount' => Habitacion::count(),
                    'reservasActivasCount' => Reserva::where('estado_id', Estado::where('nombre', 'reservado')->first()->id)->count(),
                    'clientesCount' => User::role('Cliente')->count(),
                    'proximasSalidas' => Reserva::whereDate('fecha_salida', '>=', now())->orderBy('fecha_salida')->limit(5)->get(),
                    'ocupacionPorcentaje' => $this->calcularOcupacion(),
                    'habitacionesDisponibles' => Habitacion::whereHas('estado', fn($q) => $q->where('nombre', 'disponible'))->count(),
                    'habitacionesMantenimiento' => Habitacion::whereHas('estado', fn($q) => $q->where('nombre', 'en mantenimiento'))->count(),
                ]
            );
        }
        $habitaciones = Habitacion::all();
        $servicios = Servicio::all();
        return view('sistema.dashboards.cliente', compact('habitaciones', 'servicios'));
    }

    protected function calcularOcupacion()
    {
        $total = Habitacion::count();
        $ocupadas = Habitacion::whereHas('estado', fn($q) => $q->where('nombre', 'reservado'))->count();
        return $total > 0 ? round(($ocupadas / $total) * 100, 2) : 0;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
