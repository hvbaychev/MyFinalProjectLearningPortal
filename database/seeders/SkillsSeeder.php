<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Skill::create([
            'user_id' => 1,
            'description' => 'Basket-weaving'
        ]);

        Skill::create([
            'user_id' => 2,
            'description' => 'Ride a Bike'
        ]);

        Skill::create([
            'user_id' => 3,
            'description' => 'Juggle'
        ]);

        Skill::create([
            'user_id' => 4,
            'description' => 'Wink'
        ]);

        Skill::create([
            'user_id' => 5,
            'description' => 'Skateboarding'
        ]);

        Skill::create([
            'user_id' => 6,
            'description' => 'Swim'
        ]);

        Skill::create([
            'user_id' => 7,
            'description' => 'Snorkel'
        ]);

        Skill::create([
            'user_id' => 8,
            'description' => 'Scuba Diving'
        ]);
    }
}
