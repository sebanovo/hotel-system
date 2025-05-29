<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class ServicioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Gestionar servicios')->only(
            ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'csv', 'pdf']
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $servicios = Servicio::all();
        return view('sistema.servicios.mostrar_servicios', compact(('servicios')));
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
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
        ]);
        $servicio = new Servicio();
        $servicio->nombre = $request->input('nombre');
        $servicio->descripcion = $request->input('descripcion');
        $servicio->precio = $request->input('precio');
        $servicio->save();
        return back()->with('success', 'Servicio creado con éxito');
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
        $servicio = Servicio::find($id);
        $servicio->nombre = $request->input('nombre');
        $servicio->descripcion = $request->input('descripcion');
        $servicio->precio = $request->input('precio');
        $servicio->save();
        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $servicio = Servicio::find($id);
        $servicio->delete();
        return back()->with('success', 'Servicio eliminado con éxito');
    }

    public function csv()
    {
        $servicios = Servicio::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=servicios.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($servicios) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, ['ID', 'Nombre', 'Descripción', 'Precio (Bs)']);
            foreach ($servicios as $servicio) {
                fputcsv($handle, [$servicio->id, $servicio->nombre, $servicio->descripcion, number_format($servicio->precio, 2)]);
            }
            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function pdf()
    {
        $servicios = Servicio::all();
        $pdf = Pdf::loadView('sistema.pdf.servicios', compact('servicios'));
        return $pdf->download('servicios.pdf');
    }
}
