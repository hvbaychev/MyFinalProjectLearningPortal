<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserHomeworkTask;

class UserHomeworkTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserHomeworkTask::create([
            'homework_task_id' => 1,
            'user_id' => 3,
            'description' => 'user homework task 1',
        ]);

        UserHomeworkTask::create([
            'homework_task_id' => 2,
            'user_id' => 5,
            'description' => 'user homework task 2',
        ]);

        UserHomeworkTask::create([
            'homework_task_id' => 3,
            'user_id' => 6,
            'description' => 'user homework task 3',
        ]);
    }
}
