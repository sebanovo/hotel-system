<?php

namespace App\Http\Controllers;

use App\Models\DetalleReserva;
use App\Models\Estado;
use App\Models\Habitacion;
use App\Models\NotaVenta;
use App\Models\Reserva;
use App\Models\TipoPago;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Gestionar reservas')->only(
            ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'csv', 'pdf']
        );
        $this->middleware('can:Reservar Habitacion')->only(
            ['reservarHabitacion']
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $reservas = Reserva::with('detalle_reservas.habitacion')->get();
        return view('sistema.reservas.mostrar_reservas', compact(('reservas')));
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
            'cliente_id' => 'required|exists:users,id',
            'habitacion_id' => 'required|exists:habitacions,id',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_salida' => 'required|date|after:fecha_inicio',
        ]);

        $estaReservado = DetalleReserva::where('habitacion_id', $request->habitacion_id)
            ->whereHas('reservas', function ($query) use ($request) {
                $query->where('estado_id', Estado::where('nombre', 'reservado')->first()->id)
                    ->where(function ($query) use ($request) {
                        $query->whereBetween('fecha_inicio', [$request->fecha_inicio, $request->fecha_salida])
                            ->orWhereBetween('fecha_salida', [$request->fecha_inicio, $request->fecha_salida]);
                    });
            })->exists();

        if ($estaReservado) {
            return redirect()->back()->with('error', 'La habitación ya está reservada en las fechas seleccionadas.');
        }

        $habitacion = Habitacion::findOrFail($request->habitacion_id);
        // Verificar si la habitación está disponible
        if ($habitacion->estado_id != Estado::where('nombre', 'disponible')->first()->id) {
            return redirect()->back()->with('error', 'La habitación no está disponible para reservar.');
        }

        // Calcular la cantidad de noches
        $fechaInicio = Carbon::parse($request->fecha_inicio);
        $fechaSalida = Carbon::parse($request->fecha_salida);
        $cantidadNoches = $fechaInicio->diffInDays($fechaSalida);

        // Calcular el precio total
        $precioPorNoche = $habitacion->precio;
        $montoTotal = $precioPorNoche * $cantidadNoches;

        $cliente = User::findOrFail($request->cliente_id);
        $reserva = Reserva::create([
            'user_cliente_id' => $cliente->id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_salida' => $request->fecha_salida,
            'estado_id' => Estado::where('nombre', 'reservado')->first()->id,
        ]);

        $reserva->habitaciones()->attach($habitacion->id, [
            'precio_v' => $precioPorNoche,
            'cantidad' => $cantidadNoches,
        ]);

        NotaVenta::create([
            'reserva_id' => $reserva->id,
            'monto_total' => $montoTotal,
            'user_cliente_id' => $cliente->id,
            'fecha' => Carbon::now(),
            'tipo_pago_id' => 1 // efectivo
        ]);

        return redirect()->route('entradas.index')->with('success', 'Reserva creada correctamente.');
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
        $reserva = Reserva::find($id);
        $reserva->estado_id = $request->input('estado');
        $reserva->save();
        return redirect()->route('reservas.index')->with('success', 'Servicio actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $reserva = Reserva::find($id);
        $reserva->delete();
        return back()->with('success', 'Servicio eliminado con éxito');
    }

    public function csv()
    {
        $reservas = Reserva::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=reservas.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($reservas) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, ['ID', 'Inicio', 'Salida', 'Estado', 'Cliente', 'Habitación']);
            foreach ($reservas as $reserva) {
                fputcsv($handle, [
                    $reserva->id,
                    $reserva->fecha_inicio,
                    $reserva->fecha_salida,
                    $reserva->estado->nombre,
                    $reserva->cliente_users->name,
                    $reserva->detalle_reservas->map(function ($detalle) {
                        return $detalle->habitacion->id;
                    })->implode(', ')
                ]);
            }
            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function pdf()
    {
        $reservas = Reserva::all();
        $pdf = Pdf::loadView('sistema.pdf.reservas', compact('reservas'));
        return $pdf->download('reservas.pdf');
    }

    public function reservarHabitacion(Request $request)
    {
        //
        $request->validate([
            'habitacion_id' => 'required|exists:habitacions,id',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_salida' => 'required|date|after:fecha_inicio',
        ]);

        $estaReservado = DetalleReserva::where('habitacion_id', $request->habitacion_id)
            ->whereHas('reservas', function ($query) use ($request) {
                $query->where('estado_id', Estado::where('nombre', 'reservado')->first()->id)
                    ->where(function ($query) use ($request) {
                        $query->whereBetween('fecha_inicio', [$request->fecha_inicio, $request->fecha_salida])
                            ->orWhereBetween('fecha_salida', [$request->fecha_inicio, $request->fecha_salida]);
                    });
            })->exists();

        if ($estaReservado) {
            return redirect()->back()->with('error', 'La habitación ya está reservada en las fechas seleccionadas.');
        }

        $habitacion = Habitacion::findOrFail($request->habitacion_id);
        // Verificar si la habitación está disponible
        if ($habitacion->estado_id != Estado::where('nombre', 'disponible')->first()->id) {
            return redirect()->back()->with('error', 'La habitación no está disponible para reservar.');
        }

        // Calcular la cantidad de noches
        $fechaInicio = Carbon::parse($request->fecha_inicio);
        $fechaSalida = Carbon::parse($request->fecha_salida);
        $cantidadNoches = $fechaInicio->diffInDays($fechaSalida);

        // Calcular el precio total
        $precioPorNoche = $habitacion->precio;
        $montoTotal = $precioPorNoche * $cantidadNoches;

        $cliente = Auth::user();
        $reserva = Reserva::create([
            'user_cliente_id' => $cliente->id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_salida' => $request->fecha_salida,
            'estado_id' => Estado::where('nombre', 'reservado')->first()->id,
        ]);

        $reserva->habitaciones()->attach($habitacion->id, [
            'precio_v' => $precioPorNoche,
            'cantidad' => $cantidadNoches,
        ]);

        NotaVenta::create([
            'reserva_id' => $reserva->id,
            'monto_total' => $montoTotal,
            'user_cliente_id' => $cliente->id,
            'fecha' => Carbon::now(),
            'tipo_pago_id' => 3 // transferencia bancaria
        ]);

        return redirect()->route('dashboard')->with('success', 'Reserva creada correctamente.');
    }
}
