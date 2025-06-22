<?php

namespace App\Http\Controllers;

use App\Models\NotaVenta;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ServicioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Gestionar servicios')->only(
            ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'csv', 'pdf', 'asignarServicio']
        );
        $this->middleware('can:Solicitar servicio')->only(
            ['comprarServicio']
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
        $servicios = Servicio::all();
        $clientes = User::role('Cliente')->get();
        return view('sistema.servicios.asignar_servicio', compact('servicios', 'clientes'));
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

    public function showServicio(string $id)
    {
        $servicio = Servicio::find($id);
        if (!$servicio) {
            return back()->with('error', 'Servicio no encontrado.');
        }

        $cliente = Auth::user();
        return view('sistema.servicios.comprar_servicio', compact('servicio', 'cliente'));
    }

    public function comprarServicio(Request $request, string $id)
    {
        $servicio = Servicio::find($id);
        if (!$servicio) {
            return back()->with('error', 'Servicio no encontrado.');
        }

        NotaVenta::create([
            'user_cliente_id' => Auth::id(),
            'servicio_id' => $servicio->id,
            'monto_total' => $servicio->precio,
            'tipo_pago_id' => 2, // Tarjeta de crédito
            'fecha' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Servicio comprado con éxito');
    }

    public function asignarServicio(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:users,id',
            'servicio_id' => 'required|exists:servicios,id',
        ]);

        NotaVenta::create([
            'user_cliente_id' => $request->cliente_id,
            'servicio_id' => $request->servicio_id,
            'monto_total' => Servicio::find($request->servicio_id)->precio,
            'tipo_pago_id' => 1, // Efectivo
            'fecha' => now(),
        ]);

        return redirect()->back()->with('success', 'Servicio asignado correctamente al cliente.');
    }
}
