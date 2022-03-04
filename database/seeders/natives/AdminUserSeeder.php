<?php

namespace Database\Seeders\Natives;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'AdminTest',
            'email' => 'Admin@cpnv.ch',
            'first_name' => 'Admin',
            'last_name' => 'Test',
            'role_id' => '1',
        ]);
    }
}
