<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class PermisoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Administrar roles y permisos')->only(
            ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'csv', 'pdf']
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $permisos = Permission::all();
        return view('sistema.roles_y_permisos.permisos', compact('permisos'));
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
        $permiso = Permission::create(['name' => $request->input('nombre')]);
        return back();
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
        $permiso = Permission::find($id);
        $permiso->name = $request->input('nombre');
        $permiso->save();
        return redirect()->route('permisos.index')->with('success', 'Permiso actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Permission::where('id', $id)->delete();
        return back()->with('success', 'Permmiso eliminado con éxito');
    }

    public function csv()
    {
        $permisos = Permission::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=permisos.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($permisos) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, ['ID', 'Nombre']);
            foreach ($permisos as $permiso) {
                fputcsv($handle, [$permiso->id, $permiso->name]);
            }
            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function pdf()
    {
        $permisos = Permission::all();
        $pdf = Pdf::loadView('sistema.pdf.permisos', compact('permisos'));
        return $pdf->download('permisos.pdf');
    }
}
