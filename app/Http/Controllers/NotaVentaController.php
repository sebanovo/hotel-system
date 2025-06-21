<?php

namespace App\Http\Controllers;

use App\Models\NotaVenta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class NotaVentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Gestionar nota ventas')->only(
            ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'csv', 'pdf']
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $notaventas = NotaVenta::all();
        return view('sistema.notas_ventas.nota_ventas', compact('notaventas'));
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

    public function csv()
    {
        $notaventas = NotaVenta::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=notaventas.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($notaventas) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, ['ID', 'Fecha', 'Monto', 'Cliente', 'Email']);
            foreach ($notaventas as $notaventa) {
                fputcsv($handle, [
                    $notaventa->id,
                    $notaventa->fecha,
                    $notaventa->monto_total,
                    $notaventa->cliente->name,
                    $notaventa->cliente->email,
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function pdf()
    {
        $notaventas = NotaVenta::all();
        $pdf = Pdf::loadView('sistema.pdf.nota_ventas', compact('notaventas'));
        return $pdf->download('notaventas.pdf');
    }
}
