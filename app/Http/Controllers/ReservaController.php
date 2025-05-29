<?php

namespace App\Http\Controllers;

use App\Models\DetalleReserva;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class ReservaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Gestionar reservas')->only(
            ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'csv', 'pdf']
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $reservas = Reserva::with('detalle_reservas.habitacion')->get();
        return view('sistema.reservas.mostrar_reservas', compact(('reservas')));
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
        $reserva = Reserva::find($id);
        $reserva->estado_id = $request->input('estado');
        $reserva->save();
        return redirect()->route('reservas.index')->with('success', 'Servicio actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $reserva = Reserva::find($id);
        $reserva->delete();
        return back()->with('success', 'Servicio eliminado con éxito');
    }

    public function csv()
    {
        $reservas = Reserva::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=reservas.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($reservas) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, ['ID', 'Inicio', 'Salida', 'Estado', 'Cliente']);
            foreach ($reservas as $reserva) {
                fputcsv($handle, [
                    $reserva->id,
                    $reserva->fecha_inicio,
                    $reserva->fecha_salida,
                    $reserva->estado->nombre,
                    $reserva->cliente_users->name
                ]);
            }
            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function pdf()
    {
        $reservas = Reserva::all();
        $pdf = Pdf::loadView('sistema.pdf.reservas', compact('reservas'));
        return $pdf->download('reservas.pdf');
    }
}
