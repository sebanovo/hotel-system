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
