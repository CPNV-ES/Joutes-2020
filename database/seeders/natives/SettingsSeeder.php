<?php

namespace Database\Seeders\Natives;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //['name'=>'','group'=>'','val'=>''];
        $settings = [
            ['name'=>'REQUIRED_CLASSES','group'=>'default','val'=>'SI-C1a,SI-C1b,SI-C2a,SI-C2b,SI-C3a,SI-C3b,SI-C4a,SI-C4b,SI-CA1a,SI-CA2a,SI-MI1a,SI-MI1b,SI-MI2a,SI-MI2b,SI-MI3a,SI-C4r,SI-MI3b,SI-MI4a,SI-MI4b,SM-C1a,SM-C1b,SM-C1c,SM-C2a,SM-C2b,SM-C2c,SM-C3a,SM-C3b,SM-C3c,SM-C4a,SM-C4b,SM-C4r,SM-CA1a,SM-CA2a,SM-MI1a,SM-MI1b,SM-MI1c,SM-MI2a,SM-MI2b,SM-MI2c,SM-MI3c,SM-MI4a,SM-P1a,SP-C1a,SP-C2a,SP-C3a,SP-C4a,SP-CA1a,SP-CA2a,SP-MI1a,SP-MI2a,SP-MI3a,SP-MI4a,SP-P1a,SPFI-S1a']
        ];
        DB::table('settings')->insert($settings);
    }
}
