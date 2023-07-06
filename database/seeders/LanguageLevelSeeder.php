<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LanguageLevel;
use Illuminate\Support\Facades\Hash;

class LanguageLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LanguageLevel::create([
            'name' => 'A1 Level (Basic)',
        ]);

        LanguageLevel::create([
            'name' => 'A2 Level (Basic)',
        ]);

        LanguageLevel::create([
            'name' => 'B1 Level (Independent)',
        ]);

        LanguageLevel::create([
            'name' => 'B2 Level (Independent)',
        ]);

        LanguageLevel::create([
            'name' => 'C1 Level (Proficient)',
        ]);

        LanguageLevel::create([
            'name' => 'C2 Level (Proficient)',
        ]);

    }
}
