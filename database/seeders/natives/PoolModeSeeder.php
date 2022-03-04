<?php

namespace Database\Seeders\Natives;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoolModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pool_modes')->insert([
            0 => [
                'mode_description' => 'Matches simples',
                'planningAlgorithm' => '1',
            ],
            1 => [
                'mode_description' => 'Aller-retour',
                'planningAlgorithm' => '2',
            ],
            2 => [
                'mode_description' => 'Elimination directe',
                'planningAlgorithm' => '3',
            ]
        ]);
    }
}
