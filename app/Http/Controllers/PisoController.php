<?php

namespace App\Http\Controllers;

use App\Models\Piso;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PisoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Gestionar pisos')->only(
            ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'csv', 'pdf']
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pisos = Piso::all();
        return view('sistema.pisos.mostrar_pisos', compact('pisos'));
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
        //
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:255',
        ]);
        $piso = new Piso();
        $piso->nombre = $request->input('nombre');
        $piso->descripcion = $request->input('descripcion');
        $piso->save();
        return back()->with('success', 'Piso creado con éxito');
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
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:255',
        ]);

        $piso = Piso::find($id);
        $piso->nombre = $request->input('nombre');
        $piso->descripcion = $request->input('descripcion');
        $piso->save();

        return redirect()->route('pisos.index')->with('success', 'Piso actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $piso = Piso::find($id);
        $piso->delete();
        return back()->with('success', 'Piso eliminada con éxito');
    }

    public function csv()
    {
        $pisos = Piso::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=pisos.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($pisos) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, ['ID', 'Nombre', 'Descripción']);
            foreach ($pisos as $piso) {
                fputcsv($handle, [
                    $piso->id,
                    $piso->nombre,
                    $piso->descripcion,
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function pdf()
    {
        $pisos = Piso::all();
        $pdf = Pdf::loadView('sistema.pdf.pisos', compact('pisos'));
        return $pdf->download('pisos.pdf');
    }
}
