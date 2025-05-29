<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class HabitacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Gestionar habitaciones')->only(
            ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'csv', 'pdf']
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $habitaciones = Habitacion::with('detalle_habitacion.articulos')->get();
        return view('sistema.habitaciones.mostrar_habitaciones', compact(('habitaciones')));
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
        $habitacion = Habitacion::find($id);
        return view('sistema.habitaciones.editar_habitacion', compact('habitacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $habitacion = Habitacion::find($id);
        $habitacion->precio = $request->input('precio');
        $habitacion->tipo_habitacion_id = $request->input('tipo_habitacion');
        $habitacion->save();
        return redirect()->route('habitaciones.index')->with('success', 'habitacion actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $habitacion = Habitacion::find($id);
        $habitacion->delete();
        return back()->with('success', 'Habitacion eliminada con éxito');
    }

    public function csv()
    {
        $habitaciones = Habitacion::all();

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

        return Response::stream($callback, 200, $headers);
    }

    public function pdf()
    {
        $habitaciones = Habitacion::all();
        $pdf = Pdf::loadView('sistema.pdf.habitaciones', compact('habitaciones'));
        return $pdf->download('habitaciones.pdf');
    }
}
