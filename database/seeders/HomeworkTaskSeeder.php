<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HomeworkTask;
use Illuminate\Support\Facades\Hash;

class HomeworkTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        HomeworkTask::create([
            'description' => 'homework task 1',
            'name' => 'homwework 1',
            'lecture_id' => 1,
        ]);

        HomeworkTask::create([
            'description' => 'homework task 2',
            'name' => 'homework 2',
            'lecture_id' => 1,
        ]);

        HomeworkTask::create([
            'description' => 'homework task 3',
            'name' => 'homework 3',
            'lecture_id' => 2,
        ]);

        HomeworkTask::create([
            'description' => 'homework task 3',
            'name' => 'homework 4',
            'lecture_id' => 2,
        ]);

    }
}
