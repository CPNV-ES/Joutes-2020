<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BadmintonTournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $db     = \Config::get('database.connections.mysql.database');
        $user   = \Config::get('database.connections.mysql.username');
        $pass   = \Config::get('database.connections.mysql.password');

        // Using mysql instance to pass a sqlfile and execute it 
        // Because on our sql file we have multiple procedure delimited by DELIMITER and those DELIMITER work ~only on MYSQL...  
        exec("mysql -u " . $user . " -p" . $pass . " -h " . \Config::get("database.connections.mysql.host") . " " . $db . " < " . database_path("sqlFiles/badmintonTournament.sql"));
    }
}
