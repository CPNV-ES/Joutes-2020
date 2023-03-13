<?php

namespace Database\Seeders;

use Database\Seeders\Natives;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Natives\RoleSeeder::class);
        $this->call(Natives\GameTypeSeeder::class);
        $this->call(Natives\PoolModeSeeder::class);
        $this->call(Natives\SportSeeder::class);
        $this->call(Natives\CourtSeeder::class);
        if (env('APP_ENV') == 'local') {
            $this->call(Natives\AdminUserSeeder::class);
            $this->call(Fakes\Joutes2022Seeder::class);
            $this->call(Fakes\FakeResultPoolState::class);
            $this->call(Fakes\UserTableSeeder::class);
            $this->call(Fakes\EventsSeeder::class);
            $this->call(Fakes\EventRoleUserSeeder::class);
        }
    }
}
