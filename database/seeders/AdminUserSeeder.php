<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'username' => 'admin',
            'first_name' => 'admin',
            'last_name' => 'admin',
            'password' => password_hash('Pa$$w0rd',PASSWORD_DEFAULT),
            'role_id' => \App\Role::where('slug','ADMIN')->first()->id
        ]);
    }
}
