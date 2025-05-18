<?php
namespace Database\Seeders;

use App\Models\PersonalData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PersonalData::create([
            'id'=>1,
            'ci'=>12999299,
            'nombre'=>'erick noel',
            'apellido'=>'sandoval martinez',
            'telefono'=>68842663,
            'user_id'=>1,
        ]);
        PersonalData::create([
            'id'=>2,
            'ci'=>129992996,
            'nombre'=>'brayan ',
            'apellido'=>'aldana claure',
            'telefono'=>68842662,
            'user_id'=>2,
        ]);
    }
}
