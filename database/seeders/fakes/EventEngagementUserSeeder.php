<?php

namespace Database\Seeders\Fakes;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EventEngagementUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 200) as $index) {
            DB::table('event_engagement_user')->insert([
                'user_id' => rand(1, 201),
                'event_id' => rand(1, 12),
                'engagement_id' => rand(1, 2),
            ]);
        }
    }
}
