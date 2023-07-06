<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'name' => 'PHP',
            'description' => 'Course about PHP',
            'logo' => 'default_logo.jpg',
            'start_date' => '2022-07-15',
            'end_date' => '2022-08-15',
            'duration' => '1 month',
        ]);

        Course::create([
            'name' => 'C',
            'description' => 'Course about C',
            'logo' => 'default_logo.jpg',
            'start_date' => '2022-07-15',
            'end_date' => '2022-08-15',
            'duration' => '1 month',
        ]);

        Course::create([
            'name' => 'Laravel',
            'description' => 'Course about Laravel',
            'logo' => 'default_logo.jpg',
            'start_date' => '2022-07-15',
            'end_date' => '2022-08-15',
            'duration' => '1 month',
        ]);


        

    }
}
