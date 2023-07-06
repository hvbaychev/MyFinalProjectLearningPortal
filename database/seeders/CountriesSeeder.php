<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::create([
            'name' => 'Bulgaria',
        ]);

        Country::create([
            'name' => 'UK',
        ]);

        Country::create([
            'name' => 'US',
        ]);

        Country::create([
            'name' => 'Brazil',
        ]);
    }
}
