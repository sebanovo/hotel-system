<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Estado;
use App\Models\Habitacion;
use App\Models\Piso;
use App\Models\User;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Gestionar entradas')->only(
            ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'checkin']
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $habitaciones = Habitacion::with('detalle_habitacion.articulos', 'estado')
            ->whereHas('estado', function ($query) {
                $query->where('nombre', 'disponible');
            })
            ->get();

        $pisos = Piso::all();
        $estado_habitaciones = Estado::all();
        $articulos = Articulo::all();

        return view('sistema.entrada.habitaciones-libres', compact('habitaciones', 'pisos', 'estado_habitaciones', 'articulos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('sistema.entrada.iniciar-recepcion');
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

    public function checkin($habitacion_id)
    {
        $habitacion = Habitacion::findOrFail($habitacion_id);
        $clientes = User::role('Cliente')->get();
        return view('sistema.entrada.iniciar-recepcion', compact('habitacion', 'clientes'));
    }
}
