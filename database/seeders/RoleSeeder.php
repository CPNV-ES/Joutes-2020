<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            0 => [
                'name' => 'Administrateur',
                'slug' => 'ADMIN',
            ],
            1 => [
                'name' => 'Gestionnaire',
                'slug' => 'GEST',
            ],
            2 => [
                'name' => 'Student',
                'slug' => 'STUD',
            ]
        ]);
    }
}
