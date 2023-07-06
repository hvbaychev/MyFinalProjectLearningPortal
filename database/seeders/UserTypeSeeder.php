<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserType::create([
            'type_name' => 'admin',
            'type_code' => UserType::ADMIN_CODE,
        ]);

        UserType::create([
            'type_name' => 'student',
            'type_code' => UserType::STUDENT_CODE,
        ]);

        UserType::create([
            'type_name' => 'teacher',
            'type_code' => UserType::TEACHER_CODE,
        ]);

        UserType::create([
            'type_name' => 'business',
            'type_code' => UserType::BUSINESS_CODE,
        ]);

        UserType::create([
            'type_name' => 'public',
            'type_code' => UserType::PUBLIC_CODE,
        ]);
    }
}
