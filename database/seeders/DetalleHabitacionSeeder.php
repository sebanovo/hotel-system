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
        // meter más artículos en las habitaciones
        foreach (range(1, 3) as $i) {
            DetalleHabitacion::create([
                'habitacion_id' => 1,
                'articulo_id' => $i,
            ]);
        }
        foreach (range(1, 6) as $i) {
            DetalleHabitacion::create([
                'habitacion_id' => 2,
                'articulo_id' => $i,
            ]);
        }
        foreach (range(3, 6) as $i) {
            DetalleHabitacion::create([
                'habitacion_id' => 3,
                'articulo_id' => $i,
            ]);
        }
        foreach (range(1, 2) as $i) {
            DetalleHabitacion::create([
                'habitacion_id' => 4,
                'articulo_id' => $i,
            ]);
        }
        foreach (range(4, 6) as $i) {
            DetalleHabitacion::create([
                'habitacion_id' => 5,
                'articulo_id' => $i,
            ]);
        }
        foreach (range(1, 6) as $i) {
            DetalleHabitacion::create([
                'habitacion_id' => 6,
                'articulo_id' => $i,
            ]);
        }
    }
}
