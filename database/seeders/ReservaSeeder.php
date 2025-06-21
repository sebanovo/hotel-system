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
        Reserva::create([
            'id' => 1,
            'fecha_inicio' => '2025-6-21',
            'fecha_salida' => '2025-6-22',
            'estado_id' => 1,
            'user_cliente_id' => 4,
        ]);
        Reserva::create([
            'id' => 2,
            'fecha_inicio' => '2025-6-21',
            'fecha_salida' => '2025-6-22',
            'estado_id' => 1,
            'user_cliente_id' => 5,
        ]);
        Reserva::create([
            'id' => 3,
            'fecha_inicio' => '2025-6-21',
            'fecha_salida' => '2025-6-22',
            'estado_id' => 1,
            'user_cliente_id' => 6,
        ]);
    }
}
