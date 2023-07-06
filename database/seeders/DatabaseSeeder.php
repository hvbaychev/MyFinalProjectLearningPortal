<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(MenuItemsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(UserTypeSeeder::class);
        $this->call(CoursesSeeder::class);
        $this->call(CourseModulesSeeder::class);
        $this->call(LecturesSeeder::class);
        $this->call(HomeworkTaskSeeder::class);
        $this->call(LanguageLevelSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(HobbiesSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(MassangerSeeder::class);
        $this->call(RepositoriesSeeder::class); 
        $this->call(SkillsSeeder::class);
        $this->call(UserHomeworkTasksSeeder::class);
        $this->call(UserLanguagesSeeder::class);
        $this->call(WebPagesSeeder::class);
        $this->call(AbsencesSeeder::class);

    }
}