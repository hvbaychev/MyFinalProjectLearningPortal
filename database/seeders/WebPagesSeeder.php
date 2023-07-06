<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WebPage;

class WebPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebPage::create([
            'user_id' => 3,
            'description' => 'www.matrix.com',
        ]);

        WebPage::create([
            'user_id' => 5,
            'description' => 'www.distributor.com',
        ]);

        WebPage::create([
            'user_id' => 6,
            'description' => 'www.sit.com',
        ]);

        WebPage::create([
            'user_id' => 7,
            'description' => 'www.up.com',
        ]);

        WebPage::create([
            'user_id' => 8,
            'description' => 'www.doubt.com',
        ]);

        WebPage::create([
            'user_id' => 1,
            'description' => 'www.slab.com',
        ]);
    }
}
