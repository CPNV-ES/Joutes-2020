<?php

namespace Database\Seeders\Natives;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('game_types')->insert([
            'game_type_description' => 'Modalités de jeu'
        ]);
    }
}
