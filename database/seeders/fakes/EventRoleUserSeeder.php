<?php

namespace Database\Seeders\Fakes;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventRoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (range(1, 10) as $index) {
            DB::table('event_role_user')->insert([
                'user_id' => rand(1, 10),
                'event_id' => rand(1, 4),
                'role_id' => rand(2, 3),
            ]);
        }
    }
}
