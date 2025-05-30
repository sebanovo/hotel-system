<?php

namespace App\Http\Controllers;

use App\Models\TipoPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class TipoPagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Gestionar tipo pagos')->only(
            ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'csv', 'pdf']
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tipo_pagos = TipoPago::all();
        return view('sistema.tipo_pago.mostrar_tipo_pago', compact(('tipo_pagos')));
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
        $tipo_pago = new TipoPago();
        $tipo_pago->nombre = $request->input('nombre');
        $tipo_pago->save();
        return back()->with('success', 'tipo_pago creado con éxito');
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
        $tipo_pago = TipoPago::find($id);
        $tipo_pago->nombre = $request->input('nombre');
        $tipo_pago->save();
        return redirect()->route('tipo_pagos.index')->with('success', 'tipo_pago actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $tipo_pago = TipoPago::find($id);
        $tipo_pago->delete();
        return back()->with('success', 'tipo_pago eliminado con éxito');
    }

    public function csv()
    {
        $tipo_pagos = TipoPago::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=tipo_pagos.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($tipo_pagos) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, ['ID', 'Nombre']);
            foreach ($tipo_pagos as $tipo_pago) {
                fputcsv($handle, [$tipo_pago->id, $tipo_pago->nombre]);
            }
            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function pdf()
    {
        $tipo_pagos = TipoPago::all();
        $pdf = Pdf::loadView('sistema.pdf.tipo_pago', compact('tipo_pagos'));
        return $pdf->download('tipo_pagos.pdf');
    }
}
