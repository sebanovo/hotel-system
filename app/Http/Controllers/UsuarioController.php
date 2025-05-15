<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $usuarios = Usuario::all();
        return view('sistema.mostrar_usuarios', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('sistema.crear_usuarios');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|string|email|max:100|unique:usuarios',
            'contraseña' => 'required|string|min:8|max:256',
        ]);
        $usuario = new Usuario();
        $usuario->nombre = $request->input('nombre');
        $usuario->correo = $request->input('correo');
        $usuario->contraseña = bcrypt($request->input('contraseña'));
        $usuario->save();
        return back()->with('success', 'Usuario creado con éxito');
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
        $usuario = Usuario::find($id);
        return view('sistema.editar_usuario', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $usuario = Usuario::find($id);

        $usuario->nombre = $request->input('nombre');
        $usuario->correo = $request->input('correo');
        $usuario->save();
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $usuario = Usuario::find($id);
        $usuario->delete();
        return back()->with('success', 'Usuario eliminado con éxito');
    }
}
