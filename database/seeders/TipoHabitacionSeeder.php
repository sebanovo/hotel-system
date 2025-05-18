<?php

namespace Database\Seeders;

use App\Models\TipoHabitacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoHabitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoHabitacion::create([
            'id' => 1,
            'nombre' => 'Habitación individual',
            'descripcion' => 'Habitación para una sola persona',
        ]);
        TipoHabitacion::create([
            'id' => 2,
            'nombre' => 'Habitación doble',
            'descripcion' => 'Habitación para dos personas',
        ]);
        TipoHabitacion::create([
            'id' => 3,
            'nombre' => 'Habitación triple',
            'descripcion' => 'Habitación para tres personas',
        ]);
        TipoHabitacion::create([
            'id' => 4,
            'nombre' => 'Habitación cuádruple',
            'descripcion' => 'Habitación para cuatro personas',
        ]);
    }
}
