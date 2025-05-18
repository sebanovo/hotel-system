<?php

namespace Database\Seeders;

use App\Models\EmpleadoServicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpleadoServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmpleadoServicio::create([
            'id' => 1,
            'fecha_asignacion' => '2025-04-27',	
            'user_id' => 1,
            'servicio_id' => 2,
        ]);
        EmpleadoServicio::create([
            'id' => 2,
            'fecha_asignacion' => '2025-04-27',	
            'user_id' => 2,
            'servicio_id' => 1,
        ]);
        EmpleadoServicio::create([
            'id' => 3,
            'fecha_asignacion' => '2025-04-27',	
            'user_id' => 3,
            'servicio_id' => 2,
        ]);
        EmpleadoServicio::create([
            'id' => 4,
            'fecha_asignacion' => '2025-04-27',	
            'user_id' => 4,
            'servicio_id' => 1,
        ]);
    }
}
