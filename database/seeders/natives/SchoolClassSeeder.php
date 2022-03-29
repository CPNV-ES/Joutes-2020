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
                'name' => 'SI-T1a',
                'status' => 'ok',
            ],
            1 => [
                'name' => 'SI-T1b',
                'status' => 'ok',
            ],
            2 => [
                'name' => 'SI-T2a',
                'status' => 'ok',
            ],
            3 => [
                'name' => 'SI-T2b',
                'status' => 'ok',
            ],
        ]);
    }
}
