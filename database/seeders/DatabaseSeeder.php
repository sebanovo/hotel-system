<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RolesAndPermissionsSeeder::class,
            ModelHasRolesSeeder::class,
            PersonalDataSeeder::class,
            PisoSeeder::class,
            EstadoSeeder::class,
            TipoHabitacionSeeder::class,
            ArticuloSeeder::class,
            ServicioSeeder::class,
            TipoPagoSeeder::class,
            HabitacionSeeder::class,
            ReservaSeeder::class,
            NotaVentaSeeder::class,
            EmpleadoServicioSeeder::class,
            DetalleServicioSeeder::class,
            DetalleVentaSeeder::class,
            DetalleReservaSeeder::class,
            DetalleHabitacionSeeder::class,
        ]);
    }
}
