<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ArticuloController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Gestionar articulos')->only(
            ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'csv', 'pdf']
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $articulos = Articulo::all();
        return view('sistema.articulos.mostrar_articulos', compact('articulos'));
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
        ]);
        $articulo = new Articulo();
        $articulo->nombre = $request->input('nombre');
        $articulo->save();
        return back()->with('success', 'articulo creado con éxito');
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
        ]);
        $articulo = Articulo::find($id);
        $articulo->nombre = $request->input('nombre');
        $articulo->save();
        return redirect()->route('articulos.index')->with('success', 'articulo actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $articulo = Articulo::find($id);
        $articulo->delete();
        return back()->with('success', 'articulo eliminado con éxito');
    }

    public function csv()
    {
        $articulos = Articulo::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=articulos.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($articulos) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, ['ID', 'Nombre']);
            foreach ($articulos as $articulo) {
                fputcsv($handle, [$articulo->id, $articulo->nombre]);
            }
            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function pdf()
    {
        $articulos = Articulo::all();
        $pdf = Pdf::loadView('sistema.pdf.articulos', compact('articulos'));
        return $pdf->download('articulos.pdf');
    }
}
