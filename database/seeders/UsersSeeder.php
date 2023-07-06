<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\UserType;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@hot.com',
            'password' => Hash::make('admin'),
            'user_type' => UserType::ADMIN_CODE,
        ]);

        User::create([
            'first_name' => 'public',
            'last_name' => 'public',
            'email' => 'public@hot.com',
            'password' => Hash::make('public'),
            'user_type' => UserType::PUBLIC_CODE,
        ]);

        User::create([
            'first_name' => 'student',
            'last_name' => 'student',
            'email' => 'student@hot.com',
            'password' => Hash::make('student'),
            'user_type' => UserType::STUDENT_CODE,
        ]);

        User::create([
            'first_name' => 'teacher',
            'last_name' => 'teacher',
            'email' => 'teacher@hot.com',
            'password' => Hash::make('teacher'),
            'user_type' => UserType::TEACHER_CODE,
        ]);

        User::create([
            'first_name' => 'business',
            'last_name' => 'business',
            'email' => 'business@hot.com',  
            'password' => Hash::make('business'),
            'user_type' => UserType::BUSINESS_CODE,
        ]);

        User::create([
            'first_name' => 'Pesho',
            'last_name' => 'Student3',
            'email' => 'p1@hot.com',
            'password' => Hash::make('student'),
            'user_type' => UserType::STUDENT_CODE,
            'phone' => '08854121454',
        ]);

        User::create([
            'first_name' => 'Gosho',
            'last_name' => 'Student4',
            'email' => 'p2@hot.com',
            'password' => Hash::make('student'),
            'user_type' => UserType::STUDENT_CODE,
            'phone' => '08854121454',
        ]);

        User::create([
            'first_name' => 'Eli',
            'last_name' => 'public',
            'email' => 'p3@hot.com',
            'password' => Hash::make('student'),
            'user_type' => UserType::STUDENT_CODE,
            'phone' => '08854121454',
        ]);

    }
}
