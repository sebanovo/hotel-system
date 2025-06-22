<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Estado;
use App\Models\Habitacion;
use App\Models\Piso;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // las reservas que esten en estado 'reservado' 
        $reservas = Reserva::with(['habitaciones', 'Cliente'])
            ->whereHas('estado', function ($query) {
                $query->where('nombre', 'reservado');
            })
            ->get();

        $pisos = Piso::all();
        $estado_habitaciones = Estado::all();
        $articulos = Articulo::all();

        return view('sistema.salida.habitaciones-ocupadas', compact('reservas', 'pisos', 'estado_habitaciones', 'articulos'));
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

    public function checkout($reserva_id)
    {
        // Cambiar el estado de la reserva a 'finalizado'
        $reserva = Reserva::findOrFail($reserva_id);
        $reserva->estado_id = Estado::where('nombre', 'finalizado')->first()->id;
        $reserva->save();
        return back()->with('success', 'Reserva finalizada correctamente.');
    }
}
