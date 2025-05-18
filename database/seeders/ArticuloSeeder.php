<?php

namespace Database\Seeders;

use App\Models\Articulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Articulo::create([
           'id' => 1,
           'nombre' => 'Televisior',
        ]);

        Articulo::create([
            'id' => 2,
            'nombre' => 'Cama',
        ]);

        Articulo::create([
            'id' => 3,
            'nombre' => 'Silla',
        ]);

        Articulo::create([
            'id' => 4,
            'nombre' => 'Mesa',
        ]);

        Articulo::create([
            'id' => 5,
            'nombre' => 'Escritorio',
        ]);
        Articulo::create([
            'id' => 6,
            'nombre' => 'Ventilador',
        ]);
        


        // EstadoEjecucion::create([
        //     'id' => 1,
        //     'nombre' => 'En Proceso',
        //     'descripcion' => 'Cuando se sigue trabajando en el examen.',
        // ]);
    }
}
