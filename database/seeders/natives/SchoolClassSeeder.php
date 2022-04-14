<?php

namespace Database\Seeders\Natives;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('school_classes')->insert([
            0 => [
                'name' => 'SI-M1a',
                'year' => '2020-2021',
                'holder' => 'GLASSEY Nicolas',
                'delegate' => 'COSTA-DOS-SANTOS	Mauro-Alexandre',
            ],
            1 => [
                'name' => 'SI-T1b',
                'year' => '2020-2021',
                'holder' => 'ROTEN Cédric',
                'delegate' => 'FAILLOUBAZ	Jeremy',
            ],
            2 => [
                'name' => 'SI-T2a',
                'year' => '2021-2022',
                'holder' => 'CARREL Xavier',
                'delegate' => 'AELLEN	Quentin',
            ],
            3 => [
                'name' => 'SI-T2b',
                'year' => '2019-2020',
                'holder' => 'WULLIAMOZ Didier',
                'delegate' => 'SOLLIARD	Yann',
            ],
            3 => [
                'name' => 'SRI-T2b',
                'year' => '2017-2018',
                'holder' => 'WULLIAMOZ Didier',
                'delegate' => 'SOLLIARD	Yann',
            ],
            4 => [
                'name' => 'SI-T1a',
                'year' => '2020-2021',
                'holder' => 'GLASSEY Nicolas',
                'delegate' => 'COSTA-DOS-SANTOS	Mauro-Alexandre',
            ],
        ]);
    }
}
