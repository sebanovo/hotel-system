<?php

namespace Database\Seeders;

use App\Models\DetalleHabitacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetalleHabitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetalleHabitacion::create([
            'id' => 1,
            'habitacion_id' => 1,
            'articulo_id' => 1,

        ]);

        DetalleHabitacion::create([
            'id' => 2,
            'habitacion_id' => 2,
            'articulo_id' => 2,

        ]);

        DetalleHabitacion::create([
            'id' => 3,
            'habitacion_id' => 3,
            'articulo_id' => 3,

        ]);

        DetalleHabitacion::create([
            'id' => 4,
            'habitacion_id' => 1,
            'articulo_id' => 4,

        ]);
    }
}
