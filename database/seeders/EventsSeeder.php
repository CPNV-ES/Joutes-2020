<?php

namespace Database\Seeders;

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
        for ($i = intval(date('Y')) - 10; $i <= intval(date('Y')); $i++) {
            DB::table('events')->insert([
                'name' => 'Joutes ' . $i,
                'img' => 'joutes.jpg',
                'eventState' =>  rand(0, 3),
            ]);
        }
    }
}
