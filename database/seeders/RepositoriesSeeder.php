<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Repository;

class RepositoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Repository::create([
            'user_id' => 1,
            'description' => 'momentous-locket'
        ]);

        Repository::create([
            'user_id' => 2,
            'description' => 'general-structure'
        ]);

        Repository::create([
            'user_id' => 3,
            'description' => 'general-grass'
        ]);

        Repository::create([
            'user_id' => 4,
            'description' => 'silent-reward'
        ]);

        Repository::create([
            'user_id' => 5,
            'description' => 'nebulous-advertisement'
        ]);

        Repository::create([
            'user_id' => 6,
            'description' => 'calm-party'
        ]);

        Repository::create([
            'user_id' => 7,
            'description' => 'quick.vegetable'
        ]);
    }
}
