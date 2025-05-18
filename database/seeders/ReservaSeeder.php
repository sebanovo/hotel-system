<?php

namespace Database\Seeders;

use App\Models\Reserva;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // serva::create([
        //     'id' => 1,
        //     'usuario_id' => 1,
        //     'piso_id' => 1,
        //     'fecha' => '2022-01-01',
        //     'hora' => '12:00:00',
        //     'tipo_habitacion_id' => 1,
        //     'estado' => 'reservado',
        //     'precio' => 100,
        //     'descuento' => 0,
        //     'servicio_id' => 2,
        //     'pago' => 1,
        // ]);
        // Reserva::create([
        //     'id' => 2,
        //     'usuario_id' => 2,
        //     'piso_id' => 2,
        //     'fecha' => '2022-01-02',
        //     'hora' => '13:00:00',
        //     'tipo_habitacion_id' => 2,
        //     'estado' => 'reservado',
        //     'precio' => 100,
        //     'descuento' => 0,
        //     'servicio_id' => 2,
        //     'pago' => 1,
        // ]);
        // Reserva::create([
        //     'id' => 3,
        //     'usuario_id' => 1,
        //     'piso_id' => 3,
        //     'fecha' => '2022-01-03',
        //     'hora' => '14:00:00',
        //     'tipo_habitacion_id' => 3,
        //     'estado' => 'reservado',
        //     'precio' => 100,
        //     'descuento' => 0,
        //     'servicio_id' => 2,
        //     'pago' => 1,
        // ]);
        Reserva::create([
            'id' => 1,
            'fecha_inicio' => '2022-01-01',
            'fecha_salida' => '2022-01-02',
            'estado_id' => 1,
            'user_cliente_id' => 1,
        ]);
        Reserva::create([
            'id' => 2,
            'fecha_inicio' => '2022-01-02',
            'fecha_salida' => '2022-01-03',
            'estado_id' => 1,
            'user_cliente_id' => 2,
        ]);
        Reserva::create([
            'id' => 3,
            'fecha_inicio' => '2022-01-03',
            'fecha_salida' => '2022-01-04',
            'estado_id' => 1,
            'user_cliente_id' => 1,
        ]);
    }
}
