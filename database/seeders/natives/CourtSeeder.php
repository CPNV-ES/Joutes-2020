<?php

namespace Database\Seeders\Natives;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courts')->insert([
            0 => [
                'name' => 'Lac',
                'acronym' => 'LAC',
                'sport_id' => 1,
            ],
            1 => [
                'name' => 'Montagne',
                'acronym' => 'MTN',
                'sport_id' => 1,
            ],
            2 => [
                'name' => 'Court 1',
                'acronym' => 'CT1',
                'sport_id' => 2,
            ],
            3 => [
                'name' => 'Court 2',
                'acronym' => 'CT2',
                'sport_id' => 2,
            ],
            4 => [
                'name' => 'Court 3',
                'acronym' => 'CT3',
                'sport_id' => 2,
            ],
            5 => [
                'name' => 'Court 4',
                'acronym' => 'CT4',
                'sport_id' => 2,
            ],
            6 => [
                'name' => 'Court 5',
                'acronym' => 'CT5',
                'sport_id' => 2,
            ],
            7 => [
                'name' => 'Court 6',
                'acronym' => 'CT6',
                'sport_id' => 2,
            ],
            8 => [
                'name' => 'Court 1',
                'acronym' => 'CT1',
                'sport_id' => 3,
            ],
            9 => [
                'name' => 'Court 2',
                'acronym' => 'CT2',
                'sport_id' => 3,
            ],
            10 => [
                'name' => 'Court 1',
                'acronym' => 'CT1',
                'sport_id' => 4,
            ],
            11 => [
                'name' => 'Court 2',
                'acronym' => 'CT2',
                'sport_id' => 4,
            ],
            12 => [
                'name' => 'Piste 1',
                'acronym' => 'PT1',
                'sport_id' => 5,
            ],
            13 => [
                'name' => 'Piste 2',
                'acronym' => 'PT2',
                'sport_id' => 5,
            ],
            14 => [
                'name' => 'Piste 3',
                'acronym' => 'PT3',
                'sport_id' => 5,
            ],
            15 => [
                'name' => 'Piste 4',
                'acronym' => 'PT4',
                'sport_id' => 5,
            ],
            16 => [
                'name' => 'Terrain A',
                'acronym' => 'TA',
                'sport_id' => 6,
            ],
            17 => [
                'name' => 'Terrain B',
                'acronym' => 'TB',
                'sport_id' => 6,
            ],
            18 => [
                'name' => 'Sainte-Croix et alentours',
                'acronym' => 'Stex',
                'sport_id' => 6,
            ],

        ]);
    }
}
