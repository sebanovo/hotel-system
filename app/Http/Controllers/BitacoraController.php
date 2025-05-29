<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class BitacoraController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Gestionar bitacoras')->only(
            ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'csv', 'pdf']
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bitacoras = Bitacora::with('user')->latest()->paginate(20);
        return view('sistema.bitacora.mostrar_bitacora', compact('bitacoras'));
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
        $bitacoras = Bitacora::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=bitacora.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($bitacoras) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, ['ID', 'Usuario', 'Correo', 'IP', 'Accion', 'Fecha y Hora']);
            foreach ($bitacoras as $bitacora) {
                fputcsv($handle, [
                    $bitacora->id,
                    $bitacora->user->name,
                    $bitacora->user->email,
                    $bitacora->ip,
                    $bitacora->accion,
                    $bitacora->created_at->format('d/m/Y H:i:s')
                ]);
            }
            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function pdf()
    {
        $bitacoras = Bitacora::all();
        $pdf = Pdf::loadView('sistema.pdf.bitacora', compact('bitacoras'));
        return $pdf->download('bitacora.pdf');
    }
}
