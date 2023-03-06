<?php

namespace Database\Seeders\Fakes;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            DB::table('users')->insert([
                'username' => $faker->userName,
                'password' => bcrypt('secret'),
                'email' => $faker->email,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'role_id' => 3
            ]);
            DB::table('team_users')->insert([
                'user_id' => $index,
                'team_id' => rand(1, 68),
                'isCaptain' => $faker->boolean
            ]);
        }
    }
}
