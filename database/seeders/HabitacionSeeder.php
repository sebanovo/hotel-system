<?php

namespace Database\Seeders;

use App\Models\Habitacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HabitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Habitacion::create([
            'id' => 1,
            'nro'=> 1,
            'capacidad' => 2,
            'precio' => 100.00,
            'url_foto' => null,
            'piso_id' => 1,
            'tipo_habitacion_id' => 1,
            'estado_id' => 1,
        ]);
        Habitacion::create([
            'id' => 2,
            'nro'=> 2,
            'capacidad' => 3,
            'precio' => 150.00,
            'url_foto' => null,
            'piso_id' => 1,
            'tipo_habitacion_id' => 2,
            'estado_id' => 2,
        ]);
        Habitacion::create([
            'id' => 3,
            'nro'=> 3,
            'capacidad' => 4,
            'precio' => 200.00,
            'url_foto' => null,
            'piso_id' => 2,
            'tipo_habitacion_id' => 1,
            'estado_id' => 3,
        ]);
        Habitacion::create([
            'id' => 4,
            'nro'=> 4,
            'capacidad' => 5,
            'precio' => 250.00,
            'url_foto' => null,
            'piso_id' => 2,
            'tipo_habitacion_id' => 2,
            'estado_id' => 1,
        ]);
    }
}
