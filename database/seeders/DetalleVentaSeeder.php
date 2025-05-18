<?php

namespace Database\Seeders;

use App\Models\DetalleVenta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetalleVentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetalleVenta::create([
            'id' => 1,
            'precio_v' => 100.00,	
            'cantidad' => 2,
            'nota_venta_id' => 1,
            'habitacion_id' => 1,
        ]);
        DetalleVenta::create([
            'id' => 2,
            'precio_v' => 150.00,	
            'cantidad' => 1,
            'nota_venta_id' => 1,
            'habitacion_id' => 2,
        ]);
        DetalleVenta::create([
            'id' => 3,
            'precio_v' => 200.00,	
            'cantidad' => 3,
            'nota_venta_id' => 2,
            'habitacion_id' => 3,
        ]);
        DetalleVenta::create([
            'id' => 4,
            'precio_v' => 250.00,	
            'cantidad' => 1,
            'nota_venta_id' => 2,
            'habitacion_id' => 4,
        ]);
    }
}
