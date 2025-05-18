<?php

namespace Database\Seeders;

use App\Models\DetalleReserva;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetalleReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetalleReserva::create([
            'id' => 1,
            'precio_v' => 100.00,	
            'cantidad' => 2,
            'reserva_id' => 1,
            'habitacion_id' => 1,
           
        ]);
        DetalleReserva::create([
            'id' => 2,
            'precio_v' => 150.00,	
            'cantidad' => 1,
            'reserva_id' => 1,
            'habitacion_id' => 2,
           
        ]);
        DetalleReserva::create([
            'id' => 3,
            'precio_v' => 200.00,	
            'cantidad' => 3,
            'reserva_id' => 2,
            'habitacion_id' => 3,
           
        ]);
        DetalleReserva::create([
            'id' => 4,
            'precio_v' => 250.00,	
            'cantidad' => 1,
            'reserva_id' => 2,
            'habitacion_id' => 4,
           
        ]);
    }
}
