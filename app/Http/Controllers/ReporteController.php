<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Habitacion;
use App\Models\Reserva;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

use function Psy\debug;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $estados = Estado::all();
        return view('sistema.reporte.reporte', compact('estados'));
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

    public function habitacionesExportar(Request $request)
    {
        $request->validate([
            'estado_id' => 'nullable|exists:estados,id',
        ]);
        $habitaciones = Habitacion::with('estado')
            ->when($request->estado, function ($query) use ($request) {
                return $query->where('estado_id', $request->estado);
            })
            ->get();

        if ($request->formato === 'csv') {
            $headers = [
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=habitaciones.csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            ];

            $callback = function () use ($habitaciones) {
                $handle = fopen('php://output', 'w');
                fwrite($handle, "\xEF\xBB\xBF");
                fputcsv($handle, ['Nro', 'Capacidad', 'Precio (Bs)', 'Piso', 'Tipo', 'Articulos']);
                foreach ($habitaciones as $habitacion) {
                    fputcsv($handle, [
                        $habitacion->nro,
                        $habitacion->capacidad,
                        number_format($habitacion->precio, 2),
                        $habitacion->piso->nombre,
                        $habitacion->tipo_habitacion->nombre,
                        $habitacion->detalle_habitacion->map(function ($detalle) {
                            return str_replace(' ', '', $detalle->articulos->nombre);
                        })->implode(', '),
                    ]);
                }
                fclose($handle);
            };

            return response()->stream($callback, 200, $headers);
        } elseif ($request->formato === 'pdf') {
            $pdf = Pdf::loadView('sistema.pdf.habitaciones', compact('habitaciones'));
            return $pdf->download('habitaciones.pdf');
        }
    }

    public function reservasExportar(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estado_id' => 'nullable|exists:estados,id',
        ]);

        $reservas = Reserva::whereBetween('fecha_inicio', [$request->fecha_inicio, $request->fecha_fin])
            ->when($request->estado, function ($query) use ($request) {
                return $query->where('estado_id', $request->estado);
            })
            ->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=reservas.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['ID', 'Cliente', 'Habitación', 'Fecha Inicio', 'Fecha Salida', 'Monto Total'];

        if ($request->formato === 'csv') {
            $callback = function () use ($reservas) {
                $handle = fopen('php://output', 'w');
                fwrite($handle, "\xEF\xBB\xBF");
                fputcsv($handle, ['ID', 'Inicio', 'Salida', 'Estado', 'Cliente']);
                foreach ($reservas as $reserva) {
                    fputcsv($handle, [$reserva->id, $reserva->fecha_inicio, $reserva->fecha_salida, $reserva->estado->nombre, $reserva->cliente_users->name]);
                }
                fclose($handle);
            };
            return response()->stream($callback, 200, $headers);
        } elseif ($request->formato === 'pdf') {
            $pdf = Pdf::loadView('sistema.pdf.reservas', compact('reservas'));
            return $pdf->download('reservas.pdf');
        }
    }
    public function pdf($request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);
    }
}
