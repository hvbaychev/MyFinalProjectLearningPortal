<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Absence;

class AbsencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Absence::create([
            'user_id' => 7,
            'lecture_id' => 1,
            'reason' => 'was late',
            'disregarded' => 0,
        ]);

        Absence::create([
            'user_id' => 8,
            'lecture_id' => 1,
            'reason' => 'escaped',
            'disregarded' => 0,
        ]);

        Absence::create([
            'user_id' => 7,
            'lecture_id' => 4,
            'reason' => 'did not come',
            'disregarded' => 0,
        ]);

        Absence::create([
            'user_id' => 3,
            'lecture_id' => 1,
            'reason' => 'escaped',
            'disregarded' => 0,
        ]);
    }
}
