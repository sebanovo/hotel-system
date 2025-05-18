<?php

namespace Database\Seeders;

use App\Models\DetalleServicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetalleServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetalleServicio::create([
            'id' => 1,
            'precio_v' => 100.00,
            'cantidad' => 2,
            'servicio_id' => 1,	
            'nota_venta_id' => 1,
        ]);
        DetalleServicio::create([
            'id' => 2,
            'precio_v' => 200.00,
            'cantidad' => 1,
            'servicio_id' => 2,	
            'nota_venta_id' => 1,
        ]);

        DetalleServicio::create([
            'id' => 3,
            'precio_v' => 150.00,
            'cantidad' => 3,
            'servicio_id' => 3,	
            'nota_venta_id' => 2,
        ]);


        DetalleServicio::create([
            'id' => 4,
            'precio_v' => 250.00,
            'cantidad' => 1,
            'servicio_id' => 4,	
            'nota_venta_id' => 2,
        ]);
        
    }
}
