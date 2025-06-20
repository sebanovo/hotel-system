<?php

namespace Database\Seeders;

use App\Models\NotaVenta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotaVentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NotaVenta::create([
            'id' => 1,
            'fecha' => '2023-10-01',
            'monto_total' => 100.00,
            'tipo_pago_id' => 1,
            'reserva_id' => 1,
            'user_cliente_id' => 1,
            'user_empleado_id' => null,
        ]);
        NotaVenta::create([
            'id' => 2,
            'fecha' => '2023-10-02',
            'monto_total' => 200.00,
            'tipo_pago_id' => 2,
            'reserva_id' => 2,
            'user_cliente_id' => 2,
            'user_empleado_id' => null,
        ]);
        NotaVenta::create([
            'id' => 3,
            'fecha' => '2023-10-03',
            'monto_total' => 300.00,
            'tipo_pago_id' => 1,
            'reserva_id' => 3,
            'user_cliente_id' => 3,
            'user_empleado_id' => null,
        ]);
        NotaVenta::create([
            'id' => 4,
            'fecha' => '2023-10-04',
            'monto_total' => 400.00,
            'tipo_pago_id' => 2,
            'reserva_id' => 1,
            'user_cliente_id' => 1,
            'user_empleado_id' => null,
        ]);
    }
}
