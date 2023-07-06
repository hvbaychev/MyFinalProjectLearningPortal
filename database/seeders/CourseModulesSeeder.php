<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CourseModule;
use Illuminate\Support\Facades\Hash;

class CourseModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseModule::create([
            'course_id' => '1',
            'name' => 'PHP -- OOP',
            'description' => 'Description for the moduple',

        ]);

        CourseModule::create([
            'course_id' => '2',
            'name' => 'C -- OOP',
            'description' => 'Description for the moduple',

        ]);

        CourseModule::create([
            'course_id' => '3',
            'name' => 'Laravel Module',
            'description' => 'Description for the moduple',

        ]);

        CourseModule::create([
            'course_id' => '1',
            'name' => 'PHP Module 2',
            'description' => 'Description for the moduple',

        ]);


        

    }
}
