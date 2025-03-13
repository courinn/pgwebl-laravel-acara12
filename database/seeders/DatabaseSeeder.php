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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Garini Ulima',
            'email' => 'gariniulima@gmail.com',
            'password' => bcrypt('gariniulima'),
        ]);
        User::factory()->create([
            'name' => 'Courinn',
            'email' => 'courinn@gmail.com',
            'password' => bcrypt('courinn'),
        ]);
        User::factory()->create([
            'name' => 'Arin',
            'email' => 'arin@gmail.com',
            'password' => bcrypt('arin'),
        ]);
    }
}
