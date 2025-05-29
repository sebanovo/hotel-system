<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class RoleController extends Controller
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
        $roles = Role::all();
        return view('sistema.roles_y_permisos.roles', compact('roles'));
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
        $role = Role::create(['name' => $request->input('nombre')]);
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
        $role = Role::find($id);
        $permisos = Permission::all();
        return view('sistema.roles_y_permisos.roles_permisos', compact('role', 'permisos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $role = Role::find($id);
        $role->permissions()->sync($request->input('permisos'));
        return redirect()->route('roles.index', $role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $role = Role::find($id);
        $role->delete();
        return back()->with('success', 'Rol eliminado con éxito');
    }

    public function csv()
    {
        $roles = Role::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=roles.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($roles) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, ['ID', 'Nombre']);
            foreach ($roles as $role) {
                fputcsv($handle, [$role->id, $role->name]);
            }
            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function pdf()
    {
        $roles = Role::all();
        $pdf = Pdf::loadView('sistema.pdf.roles', compact('roles'));
        return $pdf->download('roles.pdf');
    }
}
