<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin_Ina',
            'email' => 'ina@rijschool.nl',
            'password' => bcrypt('password'),
            'role' => 'Administrator',
        ]);

        User::factory()->create([
            'name' => 'SanderR',
            'email' => 'sander@rijschool.nl',
            'password' => bcrypt('password'),
            'role' => 'Instructeur',
        ]);

        User::factory()->create([
            'name' => 'LindaV',
            'email' => 'linda@rijschool.nl',
            'password' => bcrypt('password'),
            'role' => 'Instructeur',
        ]);

        User::factory()->create([
            'name' => 'ThomasB',
            'email' => 'thomas@rijschool.nl',
            'password' => bcrypt('password'),
            'role' => 'leerling',
        ]);
        
        User::factory()->create([
            'name' => 'SophieM',
            'email' => 'sophie@rijschool.nl',
            'password' => bcrypt('password'),
            'role' => 'leerling',
        ]);

        User::factory()->create([
            'name' => 'KevinD',
            'email' => 'kevin@rijschool.nl',
            'password' => bcrypt('password'),
            'role' => 'leerling',
        ]);

        User::factory()->create([
            'name' => 'EmmaS',
            'email' => 'emma@rijschool.nl',
            'password' => bcrypt('password'),
            'role' => 'leerling',
        ]);

        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@vierkantewielen.test',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);
    }
}
