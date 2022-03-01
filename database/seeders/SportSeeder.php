<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sports')->insert([
            0 => [
                'name' => 'Beach Volley',
                'description' => 'Le 4-4 de la mort',
                'min_participant' =>  12,
                'max_participant' =>  12,
            ],
            1 => [
                'name' => 'Badminton',
                'description' => 'En double mixte (ou pas)',
                'min_participant' =>  12,
                'max_participant' =>  16,
            ],
            2 => [
                'name' => 'Basket',
                'description' => 'Equipes de 5 (+1 remplaçant)',
                'min_participant' =>  12,
                'max_participant' =>  16,
            ],
            3 => [
                'name' => 'Unihockey',
                'description' => 'Equipes de 4 (+1 remplaçant)',
                'min_participant' =>  10,
                'max_participant' =>  10,
            ],
            4 => [
                'name' => 'Pétanque',
                'description' => 'Doublettes',
                'min_participant' =>  16,
                'max_participant' =>  16,
            ],
            5 => [
                'name' => 'Foot',
                'description' => 'A huit',
                'min_participant' =>  8,
                'max_participant' =>  8,
            ],
            6 => [
                'name' => 'Marche',
                'description' => 'Par là autour',
                'min_participant' =>  1,
                'max_participant' =>  100,
            ]
        ]);
    }
}
