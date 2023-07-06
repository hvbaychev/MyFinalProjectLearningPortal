<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hobby;

class HobbiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hobby::create([
            'user_id' => 3,
            'description' => 'skating',
        ]);

        Hobby::create([
            'user_id' => 6,
            'description' => 'swimming',
        ]);

        Hobby::create([
            'user_id' => 7,
            'description' => 'fitness',
        ]);

        Hobby::create([
            'user_id' => 8,
            'description' => 'hichhiking',
        ]);
    }
}
