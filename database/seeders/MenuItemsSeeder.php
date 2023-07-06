<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuItem::create([
            'title' => 'Course',
            'url' => '/course',
            'order' => 1,
        ]);

        MenuItem::create([
            'title' => 'Lecture',
            'url' => '/lecture',
            'order' => 2,
        ]);

        MenuItem::create([
            'title' => 'User',
            'url' => '/user',
            'order' => 3,
        ]);

        MenuItem::create([
            'title' => 'Grade',
            'url' => '/grade',
            'order' => 4,
        ]);

        MenuItem::create([
            'title' => 'Homework',
            'url' => '/homework',
            'order' => 5,
        ]);

        MenuItem::create([
            'title' => 'Menu',
            'url' => '/menu',
            'order' => 6,
        ]);



    }
}
