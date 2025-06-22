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
        Servicio::create([
            'id' => 6,
            'nombre' => 'Internet',
            'descripcion' => 'Servicio de internet',
            'precio' => 10.00
        ]);
        Servicio::create([
            'id' => 7,
            'nombre' => 'Gimnasio',
            'descripcion' => 'Servicio de gimnasio',
            'precio' => 25.00
        ]);
        Servicio::create([
            'id' => 8,
            'nombre' => 'Spa',
            'descripcion' => 'Servicio de spa',
            'precio' => 40.00
        ]);
        Servicio::create([
            'id' => 9,
            'nombre' => 'Piscina',
            'descripcion' => 'Servicio de piscina',
            'precio' => 35.00
        ]);
        Servicio::create([
            'id' => 10,
            'nombre' => 'Bar',
            'descripcion' => 'Servicio de bar',
            'precio' => 60.00
        ]);
        Servicio::create([
            'id' => 11,
            'nombre' => 'Restaurante',
            'descripcion' => 'Servicio de restaurante',
            'precio' => 70.00
        ]);
        Servicio::create([
            'id' => 12,
            'nombre' => 'Servicio a la habitación',
            'descripcion' => 'Servicio de entrega de alimentos y bebidas en la habitación',
            'precio' => 80.00
        ]);
        Servicio::create([
            'id' => 13,
            'nombre' => 'Servicio de conserjería',
            'descripcion' => 'Asistencia personalizada para reservas y recomendaciones',
            'precio' => 90.00
        ]);
        Servicio::create([
            'id' => 14,
            'nombre' => 'Servicio de transporte al aeropuerto',
            'descripcion' => 'Transporte desde y hacia el aeropuerto',
            'precio' => 120.00
        ]);
        Servicio::create([
            'id' => 15,
            'nombre' => 'Servicio de excursiones',
            'descripcion' => 'Organización de excursiones y actividades turísticas',
            'precio' => 150.00
        ]);
        Servicio::create([
            'id' => 16,
            'nombre' => 'Servicio de seguridad',
            'descripcion' => 'Seguridad y vigilancia en el hotel',
            'precio' => 200.00
        ]);
        Servicio::create([
            'id' => 17,
            'nombre' => 'Servicio de entretenimiento',
            'descripcion' => 'Actividades recreativas y de entretenimiento',
            'precio' => 110.00
        ]);
        Servicio::create([
            'id' => 18,
            'nombre' => 'Servicio de spa y bienestar',
            'descripcion' => 'Tratamientos de spa y bienestar',
            'precio' => 130.00
        ]);
        Servicio::create([
            'id' => 19,
            'nombre' => 'Servicio de lavandería express',
            'descripcion' => 'Lavandería con servicio rápido',
            'precio' => 25.00
        ]);
        Servicio::create([
            'id' => 20,
            'nombre' => 'Servicio de planchado',
            'descripcion' => 'Servicio de planchado de ropa',
            'precio' => 30.00
        ]);
        Servicio::create([
            'id' => 21,
            'nombre' => 'Servicio de alquiler de coches',
            'descripcion' => 'Alquiler de vehículos para los huéspedes',
            'precio' => 250.00
        ]);
        Servicio::create([
            'id' => 22,
            'nombre' => 'Servicio de cambio de divisas',
            'descripcion' => 'Cambio de moneda extranjera',
            'precio' => 5.00
        ]);
    }
}
