<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Noel',
            'email' => 'noel2002@gmail.com',
            'password' => bcrypt('123456789')
        ]);

        User::create([
            'id' => 2,
            'name' => 'Sebastian',
            'email' => 'sebastian2002@gmail.com',
            'password' => bcrypt('123456789')
        ]);

        User::create([
            'id' => 3,
            'name' => 'Aldana',
            'email' => 'aldana2002@gmail.com',
            'password' => bcrypt('123456789')
        ]);

        User::create([
            'id' => 4,
            'name' => 'Daniela',
            'email' => 'daniela2002@gmail.com',
            'password' => bcrypt('123456789')
        ]);
    }
}
