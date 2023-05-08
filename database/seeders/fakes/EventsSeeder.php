<?php

namespace Database\Seeders\Fakes;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 2020; $i < 2023; $i++) {
            DB::table('events')->insert([
                'name' => 'Joutes ' . $i,
                'img' => 'joutes.jpg',
                'eventState' =>  rand(0, 3),
            ]);
        }
    }
}
