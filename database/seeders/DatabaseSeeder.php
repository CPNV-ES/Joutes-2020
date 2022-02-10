<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(Joutes2020Seeder::class);
        $this->call(FakeResultPoolState::class);
        $this->call(UserTableSeeder::class);
        $this->call(EngagementSeeder::class);
        $this->call(EventsSeeder::class);
        $this->call(EventEngagementUserSeeder::class);
    }
}
