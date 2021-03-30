<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Création d'un utilisateur ...";
        (new \App\User([
            'username' => 'AdminTest',
            'email' => 'Admin@cpnv.ch',
            'first_name' => 'Admin',
            'last_name' => 'Test',
            'role_id' => '1',
        ]))->save();
        echo "OK";
    }
}
