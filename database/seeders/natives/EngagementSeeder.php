<?php

namespace Database\Seeders\Natives;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EngagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('engagements')->insert([
            'name' => 'Participant',
            'slug' => 'PARTICI'
        ]);
        DB::table('engagements')->insert([
            'name' => 'Marqueur',
            'slug' => 'MARQUE'
        ]);
    }
}
