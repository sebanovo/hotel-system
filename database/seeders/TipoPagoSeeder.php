<?php

namespace Database\Seeders;

use App\Models\TipoPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoPago::create([
            'id' => 1,
            'nombre' => 'Efectivo',
        ]);
        TipoPago::create([
            'id' => 2,
            'nombre' => 'Tarjeta de crédito',
        ]);
        TipoPago::create([
            'id' => 3,
            'nombre' => 'Transferencia bancaria',
        ]);
        TipoPago::create([
            'id' => 4,
            'nombre' => 'PayPal',
        ]);
    }
}
