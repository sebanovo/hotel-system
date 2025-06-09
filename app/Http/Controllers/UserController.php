<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Gestionar usuarios')->only(
            ['index', 'create', 'store', 'edit', 'update', 'destroy', 'csv', 'pdf']
        );
        $this->middleware('can:Ver perfil')->only('show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $usuarios = User::all();
        return view('sistema.usuarios.mostrar_usuarios', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('sistema.usuarios.crear_usuarios');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|max:256',
        ]);
        $usuario = new User();
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->password = bcrypt($request->input('password'));
        $usuario->save();
        $usuario->assignRole('Cliente');
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = User::findOrFail($id);

        // Si el usuario autenticado no coincide con el solicitado, aborta con 403
        if (Auth::id() !== $usuario->id) {
            abort(403, 'Forbidden');
        }
        return view('sistema.perfil.ver_perfil', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $usuario = User::find($id);
        return view('sistema.usuarios.editar_usuario', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $usuario = User::find($id);

        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->save();
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $usuario = User::find($id);
        $usuario->delete();
        return back()->with('success', 'Usuario eliminado con éxito');
    }

    public function csv()
    {
        $usuarios = User::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=usuarios.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($usuarios) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, ['ID', 'Nombre', 'Correo', 'Rol']);
            foreach ($usuarios as $usuario) {
                fputcsv($handle, [$usuario->id, $usuario->name, $usuario->email, implode(', ', $usuario->getRoleNames()->toArray())]);
            }
            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function pdf()
    {
        $usuarios = User::all();
        $pdf = Pdf::loadView('sistema.pdf.usuarios', compact('usuarios'));
        return $pdf->download('usuarios.pdf');
    }

    public function cambiarPassword(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);

        // Asegúrate de que solo el usuario autenticado pueda cambiar su propia contraseña
        if (Auth::id() !== $usuario->id) {
            abort(403, 'Forbidden');
        }

        // Validación de las contraseñas
        $request->validate([
            'actual_password'    => 'required|string|min:8|max:256',
            'nueva_password'     => 'required|string|min:8|max:256',
            'confirmar_password' => 'required|string|min:8|max:256|same:nueva_password',
        ]);

        // Verificar contraseña actual
        if (!Hash::check($request->input('actual_password'), $usuario->password)) {
            return back()->withErrors(['actual_password' => 'La contraseña actual es incorrecta.']);
        }

        // Guardar nueva contraseña hasheada
        $usuario->password = Hash::make($request->input('nueva_password'));
        $usuario->save();

        return redirect()->route('login')->with('success', 'Contraseña cambiada con éxito. Por favor, inicia sesión nuevamente.');
    }

    public function updatePhoto(Request $request, string $id)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $usuario = User::findOrFail($id);
        if (Auth::id() !== $usuario->id) {
            abort(403, 'Forbidden');
        }

        if ($usuario->profile_photo_path) {
            $rutaAnterior = str_replace('/storage/', '', $usuario->profile_photo_path);

            if (Storage::disk('public')->exists($rutaAnterior)) {
                Storage::disk('public')->delete($rutaAnterior);
            }
        }

        $path = $request->file('profile_photo')->store('imagenes', 'public');
        $usuario->profile_photo_path = Storage::url($path);
        $usuario->save();

        return back()->with('success', 'Foto actualizada correctamente.');
    }
}
