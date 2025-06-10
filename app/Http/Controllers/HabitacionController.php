<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Estado;
use App\Models\Habitacion;
use App\Models\Piso;
use App\Models\TipoHabitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class HabitacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Gestionar habitaciones')->only(
            ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'csv', 'pdf', 'foto', 'updatePhoto']
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $habitaciones = Habitacion::with('detalle_habitacion.articulos')->get();
        $pisos = Piso::all();
        $tipo_habitaciones = TipoHabitacion::all();
        $estado_habitaciones = Estado::all();
        $articulos = Articulo::all();
        return view('sistema.habitaciones.mostrar_habitaciones', compact('habitaciones', 'pisos', 'tipo_habitaciones', 'estado_habitaciones', 'articulos'));
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
        $habitacion = Habitacion::find($id);
        return view('sistema.habitaciones.actualizar_foto', compact('habitacion'));
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
        $request->validate([
            'precio' => 'required|numeric|min:0',
            'capacidad' => 'required|integer|min:1',
            'tipo' => 'required|exists:tipo_habitacions,id',
            'piso' => 'required|exists:pisos,id',
            'estado' => 'required|exists:estados,id',
        ]);

        $habitacion = Habitacion::find($id);
        $habitacion->precio = $request->input('precio');
        $habitacion->capacidad = $request->input('capacidad');
        $habitacion->tipo_habitacion_id = $request->input('tipo');
        $habitacion->piso_id = $request->input('piso');
        $habitacion->estado_id = $request->input('estado');
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

    public function updatePhoto(Request $request, string $id)
    {
        $request->validate([
            'habitacion_imagen' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $habitacion = Habitacion::findOrFail($id);

        if ($habitacion->url_foto) {
            $rutaAnterior = str_replace('/storage/', '', $habitacion->url_foto);

            if (Storage::disk('public')->exists($rutaAnterior)) {
                Storage::disk('public')->delete($rutaAnterior);
            }
        }

        $path = $request->file('habitacion_imagen')->store('imagenes', 'public');
        $habitacion->url_foto = Storage::url($path);
        $habitacion->save();

        return back()->with('success', 'Foto actualizada correctamente.');
    }
}
