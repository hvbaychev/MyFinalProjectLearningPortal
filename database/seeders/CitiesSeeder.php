<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create([
            'name' => 'Sofia',
        ]);

        City::create([
            'name' => 'London',
        ]);

        City::create([
            'name' => 'Wahington DC',
        ]);

        City::create([
            'name' => 'Plovdiv',
        ]);
    }
}
