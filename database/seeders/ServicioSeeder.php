<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        Servicio::create([
            'id' => 1,
            'nombre' => 'Alojamiento',
            'descripcion' => 'Servicio de alojamiento',
            'precio' => 100.00
        ]);
        Servicio::create([
            'id' => 2,
            'nombre' => 'Comida',
            'descripcion' => 'Servicio de comida',
            'precio' => 50.00
        ]);
        Servicio::create([
            'id' => 3,
            'nombre' => 'Limpieza',
            'descripcion' => 'Servicio de limpieza',
            'precio' => 20.00
        ]);
        Servicio::create([
            'id' => 4,
            'nombre' => 'Transporte',
            'descripcion' => 'Servicio de transporte',
            'precio' => 30.00
        ]);
        Servicio::create([
            'id' => 5,
            'nombre' => 'Lavandería',
            'descripcion' => 'Servicio de lavandería',
            'precio' => 15.00
        ]);
    }
}
