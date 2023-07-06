<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserLanguage;

class UserLanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserLanguage::create([
            'user_id' => 3, 
            'language_id' => 1,
            'level_id' => 3,

        ]);

        UserLanguage::create([
            'user_id' => 6, 
            'language_id' => 2,
            'level_id' => 4,
            
        ]);

        UserLanguage::create([
            'user_id' => 7, 
            'language_id' => 3,
            'level_id' => 5,
            
        ]);

        UserLanguage::create([
            'user_id' => 5, 
            'language_id' => 1,
            'level_id' => 4,
            
        ]);

        UserLanguage::create([
            'user_id' => 4, 
            'language_id' => 2,
            'level_id' => 3,
            
        ]);

        UserLanguage::create([
            'user_id' => 3, 
            'language_id' => 3,
            'level_id' => 2,
            
        ]);
    }
}
