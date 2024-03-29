<?php

namespace Database\Seeders\Fakes;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakeResultPoolState extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pools')->insert(array(
            //create differentes states in foot and petanque
            0 =>
            array(
                'start_time' => '09:30',
                'end_time' => '11:45',
                'poolName' => 'Terminé',
                'stage' => 1,
                'poolSize' => 4,
                'poolState' => 3,
                'tournament_id' => 6,
                'mode_id' => 1,
                'game_type_id' => 1,
            ),
            1 =>
            array(
                'start_time' => '09:30',
                'end_time' => '11:45',
                'poolName' => 'Terminé2',
                'stage' => 1,
                'poolSize' => 4,
                'poolState' => 3,
                'tournament_id' => 6,
                'mode_id' => 1,
                'game_type_id' => 1,
            ),
            2 =>
            array(
                'start_time' => '09:30',
                'end_time' => '11:45',
                'poolName' => 'En cours',
                'stage' => 2,
                'poolSize' => 4,
                'poolState' => 2,
                'tournament_id' => 6,
                'mode_id' => 1,
                'game_type_id' => 1,
            ),
        ));
        DB::table('teams')->insert(array(
            //create differentes teams
            0 =>
            array(
                'name' => 'Croustichocs',
                'tournament_id' => 6,
                'validation' => 0,
                'owner_id' => -1,
            ),
            1 =>
            array(
                'name' => 'Marcelosss',
                'tournament_id' => 6,
                'validation' => 0,
                'owner_id' => -1,
            ),
            2 =>
            array(
                'name' => 'Case De Papel',
                'tournament_id' => 6,
                'validation' => 0,
                'owner_id' => -1,
            ),
            3 =>
            array(
                'name' => 'BGdla Street',
                'tournament_id' => 6,
                'validation' => 0,
                'owner_id' => -1,
            ),
            4 =>
            array(
                'name' => 'Gwennouchka',
                'tournament_id' => 6,
                'validation' => 0,
                'owner_id' => -1,
            ),
            5 =>
            array(
                'name' => 'TeamReact',
                'tournament_id' => 6,
                'validation' => 0,
                'owner_id' => -1,
            ),
            6 =>
            array(
                'name' => 'Protecteur de data',
                'tournament_id' => 6,
                'validation' => 0,
                'owner_id' => -1,
            ),
            7 =>
            array(
                'name' => 'Charoland',
                'tournament_id' => 6,
                'validation' => 0,
                'owner_id' => -1,
            )
        ));
        DB::table('contenders')->insert(array(
            //first phase
            0 =>
            array(
                'rank_in_pool' => 1,
                'pool_id' => \App\Models\Pool::where('poolName', 'Terminé')->get()->first()->id,
                'team_id' => \App\Models\Team::where('name', 'Croustichocs')->get()->first()->id,
            ),
            1 =>
            array(
                'rank_in_pool' => 2,
                'pool_id' => \App\Models\Pool::where('poolName', 'Terminé')->get()->first()->id,
                'team_id' => \App\Models\Team::where('name', 'Marcelosss')->get()->first()->id,
            ),
            2 =>
            array(
                'rank_in_pool' => 3,
                'pool_id' => \App\Models\Pool::where('poolName', 'Terminé')->get()->first()->id,
                'team_id' => \App\Models\Team::where('name', 'Case De Papel')->get()->first()->id,
            ),
            3 =>
            array(
                'rank_in_pool' => 4,
                'pool_id' => \App\Models\Pool::where('poolName', 'Terminé')->get()->first()->id,
                'team_id' => \App\Models\Team::where('name', 'BGdla Street')->get()->first()->id,
            ),
            4 =>
            array(
                'rank_in_pool' => 1,
                'pool_id' => \App\Models\Pool::where('poolName', 'Terminé2')->get()->first()->id,
                'team_id' => \App\Models\Team::where('name', 'Gwennouchka')->get()->first()->id,
            ),
            5 =>
            array(
                'rank_in_pool' => 2,
                'pool_id' => \App\Models\Pool::where('poolName', 'Terminé2')->get()->first()->id,
                'team_id' => \App\Models\Team::where('name', 'TeamReact')->get()->first()->id,
            ),
            6 =>
            array(
                'rank_in_pool' => 3,
                'pool_id' => \App\Models\Pool::where('poolName', 'Terminé2')->get()->first()->id,
                'team_id' => \App\Models\Team::where('name', 'Protecteur de data')->get()->first()->id,
            ),
            7 =>
            array(
                'rank_in_pool' => 4,
                'pool_id' => \App\Models\Pool::where('poolName', 'Terminé2')->get()->first()->id,
                'team_id' => \App\Models\Team::where('name', 'Charoland')->get()->first()->id,
            ),
        ));
        DB::table('contenders')->insert(array(
            //second phase
            8 =>
            array(
                'pool_id' => \App\Models\Pool::where('poolName', 'En cours')->get()->first()->id,
                'team_id' => \App\Models\Team::where('name', 'Croustichocs')->get()->first()->id,
                'pool_from_id' => \App\Models\Pool::where('poolName', 'Terminé')->get()->first()->id,
            ),
            9 =>
            array(
                'pool_id' => \App\Models\Pool::where('poolName', 'En cours')->get()->first()->id,
                'team_id' => \App\Models\Team::where('name', 'Marcelosss')->get()->first()->id,
                'pool_from_id' => \App\Models\Pool::where('poolName', 'Terminé')->get()->first()->id,
            ),
            10 =>
            array(
                'pool_id' => \App\Models\Pool::where('poolName', 'En cours')->get()->first()->id,
                'team_id' => \App\Models\Team::where('name', 'Gwennouchka')->get()->first()->id,
                'pool_from_id' => \App\Models\Pool::where('poolName', 'Terminé2')->get()->first()->id,
            ),
            11 =>
            array(
                'pool_id' => \App\Models\Pool::where('poolName', 'En cours')->get()->first()->id,
                'team_id' => \App\Models\Team::where('name', 'TeamReact')->get()->first()->id,
                'pool_from_id' => \App\Models\Pool::where('poolName', 'Terminé2')->get()->first()->id,
            ),
        ));
        DB::table('games')->insert(array(
            //terminé
            0 =>
            array(
                'score_contender1' => 1,
                'score_contender2' => 8,
                'date' => '2020-06-18',
                'start_time' => '09:30',
                'contender1_id' => 73,
                'contender2_id' => 74,
                'court_id' => 17,
            ),
            1 =>
            array(
                'score_contender1' => 1,
                'score_contender2' => 8,
                'date' => '2020-06-18',
                'start_time' => '09:30',
                'contender1_id' => 73,
                'contender2_id' => 75,
                'court_id' => 17,
            ),
            2 =>
            array(
                'score_contender1' => 1,
                'score_contender2' => 8,
                'date' => '2020-06-18',
                'start_time' => '09:30',
                'contender1_id' => 73,
                'contender2_id' => 76,
                'court_id' => 17,
            ),
            3 =>
            array(
                'score_contender1' => 1,
                'score_contender2' => 8,
                'date' => '2020-06-18',
                'start_time' => '09:30',
                'contender1_id' => 74,
                'contender2_id' => 75,
                'court_id' => 17,
            ),
            4 =>
            array(
                'score_contender1' => 1,
                'score_contender2' => 8,
                'date' => '2020-06-18',
                'start_time' => '09:30',
                'contender1_id' => 74,
                'contender2_id' => 76,
                'court_id' => 17,
            ),
            5 =>
            array(
                'score_contender1' => 1,
                'score_contender2' => 8,
                'date' => '2020-06-18',
                'start_time' => '09:30',
                'contender1_id' => 75,
                'contender2_id' => 76,
                'court_id' => 17,
            ),
            6 =>
            array(
                'score_contender1' => 1,
                'score_contender2' => 8,
                'date' => '2020-06-18',
                'start_time' => '09:30',
                'contender1_id' => 77,
                'contender2_id' => 78,
                'court_id' => 18,
            ),
            7 =>
            array(
                'score_contender1' => 1,
                'score_contender2' => 8,
                'date' => '2020-06-18',
                'start_time' => '09:30',
                'contender1_id' => 77,
                'contender2_id' => 79,
                'court_id' => 18,
            ),
            8 =>
            array(
                'score_contender1' => 1,
                'score_contender2' => 8,
                'date' => '2020-06-18',
                'start_time' => '09:30',
                'contender1_id' => 77,
                'contender2_id' => 80,
                'court_id' => 18,
            ),
            9 =>
            array(
                'score_contender1' => 1,
                'score_contender2' => 8,
                'date' => '2020-06-18',
                'start_time' => '09:30',
                'contender1_id' => 78,
                'contender2_id' => 79,
                'court_id' => 18,
            ),
            10 =>
            array(
                'score_contender1' => 1,
                'score_contender2' => 8,
                'date' => '2020-06-18',
                'start_time' => '09:30',
                'contender1_id' => 78,
                'contender2_id' => 80,
                'court_id' => 18,
            ),
            11 =>
            array(
                'score_contender1' => 1,
                'score_contender2' => 8,
                'date' => '2020-06-18',
                'start_time' => '09:30',
                'contender1_id' => 79,
                'contender2_id' => 80,
                'court_id' => 18,
            ),
            //en cours
            12 =>
            array(
                'score_contender1' => 1,
                'score_contender2' => 8,
                'date' => '2020-06-18',
                'start_time' => '09:30',
                'contender1_id' => 81,
                'contender2_id' => 82,
                'court_id' => 17,
            ),
            13 =>
            array(
                'score_contender1' => 1,
                'score_contender2' => 8,
                'date' => '2020-06-18',
                'start_time' => '09:30',
                'contender1_id' => 81,
                'contender2_id' => 83,
                'court_id' => 17,
            ),
            14 =>
            array(
                'score_contender1' => 1,
                'score_contender2' => 8,
                'date' => '2020-06-18',
                'start_time' => '09:30',
                'contender1_id' => 81,
                'contender2_id' => 84,
                'court_id' => 17,
            ),
            15 =>
            array(
                'score_contender1' => null,
                'score_contender2' => null,
                'date' => '2020-06-18',
                'start_time' => '09:30',
                'contender1_id' => 82,
                'contender2_id' => 83,
                'court_id' => 17,
            ),
            16 =>
            array(
                'score_contender1' => null,
                'score_contender2' => null,
                'date' => '2020-06-18',
                'start_time' => '09:30',
                'contender1_id' => 82,
                'contender2_id' => 84,
                'court_id' => 17,
            ),
            17 =>
            array(
                'score_contender1' => null,
                'score_contender2' => null,
                'date' => '2020-06-18',
                'start_time' => '09:30:00',
                'contender1_id' => 83,
                'contender2_id' => 84,
                'court_id' => 17,
            ),
        ));
    }
}
