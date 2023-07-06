<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lecture;
use Illuminate\Support\Facades\Hash;

class LecturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lecture::create([
            'name' => 'Lecture 1',
            'module_id' => 1,
            'description' => 'lecture desc',
        ]);

        Lecture::create([
            'name' => 'Lecture 2',
            'module_id' => 2,
            'description' => 'lecture desc',
        ]);

        Lecture::create([
            'name' => 'Lecture 3',
            'module_id' => 2,
            'description' => 'lecture desc',
        ]);

        Lecture::create([
            'name' => 'Lecture 4',
            'module_id' => 1,
            'description' => 'lecture desc',
        ]);
        
    }
}
