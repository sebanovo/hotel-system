<?php

namespace Database\Seeders;

use App\Models\Piso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Piso::create([
            'id'=>1,
            'nombre'=>'Piso 1',
            'descripcion'=>'habitaciones del piso 1',
        ]);
        Piso::create([
            'id'=>2,
            'nombre'=>'Piso 2',
            'descripcion'=>'habitacones del piso 2',
        ]);
        Piso::create([
            'id'=>3,
            'nombre'=>'Piso 3',
            'descripcion'=>'habitaciones del piso 3',
        ]);
    }
}
