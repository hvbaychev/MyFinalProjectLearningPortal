<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MassangerName;

class MassangerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MassangerName::create([
            'user_id' => 1,
            'description' => 'Giggles'
        ]);

        MassangerName::create([
            'user_id' => 2,
            'description' => 'Nugget'
        ]);

        MassangerName::create([
            'user_id' => 3,
            'description' => 'Teacup'
        ]);

        MassangerName::create([
            'user_id' => 4,
            'description' => 'Kiddo'
        ]);

        MassangerName::create([
            'user_id' => 5,
            'description' => 'Smarty'
        ]);

        MassangerName::create([
            'user_id' => 6,
            'description' => 'Boomer'
        ]);
    }
}
