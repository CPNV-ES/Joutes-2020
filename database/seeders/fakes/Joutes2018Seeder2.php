<?php

namespace Database\Seeders\Fakes;

use Illuminate\Database\Seeder;

class Joutes2018Seeder extends Seeder
{
    private $eventid;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $db = \Config::get('database.connections.mysql.database');
        $user = \Config::get('database.connections.mysql.username');
        $pass = \Config::get('database.connections.mysql.password');

        $event = \App\Event::where('name', 'like', '%2018%')->first();
        if (!$event) die("L'événement n'existe pas\n");
        $this->eventid = $event->id;

        // make room
        \Illuminate\Support\Facades\DB::statement('delete from games;');
        \Illuminate\Support\Facades\DB::statement('delete from contenders;');
        \Illuminate\Support\Facades\DB::statement('delete from pools;');

        $this->basics();
        $this->BeachVolley();
        $this->Basket();
        $this->UniHockey();
        $this->Badminton();
    }

    // Common stuff
    private function basics()
    {
        (new \App\GameType(['game_type_description' => 'Modalités de jeu']))->save();

        (new \App\PoolMode([
            'mode_description' => 'Matches simples',
            'planningAlgorithm' => '1',
        ]))->save();
        (new \App\PoolMode([
            'mode_description' => 'Aller-retour',
            'planningAlgorithm' => '2',
        ]))->save();
        (new \App\PoolMode([
            'mode_description' => 'Elimination directe',
            'planningAlgorithm' => '3',
        ]))->save();
    }

    private function Badminton()
    {
        echo "Badminton\n";
        $bv = \App\Tournament::where('name', 'like', '%Badmin%')->first();
        if (!$bv) {
            echo "Le tournoi de badminton n'existe pas\n";
            return;
        }
        $tournamentid = $bv->id;
        $sportid = $bv->sport_id;

        $teams = \App\Team::where('tournament_id', '=', $tournamentid)->get();

        echo "Tournoi #$tournamentid, " . $teams->count() . " équipes inscrites\n";
        //================================================================================================================
        echo "Championnat\n";

        $pool = new \App\Pool([
            'tournament_id' => $tournamentid,
            'start_time' => '09:30',
            'end_time' => '16:00',
            'poolName' => 'The Battle',
            'mode_id' => 1,
            'game_type_id' => 1,
            'poolSize' => 13,
            'stage' => 1,
            'isFinished' => 0
        ]);
        $pool->save();
        $firstpoolStage1 = $pool->id; // we'll need that to put teams into pools


        foreach ($teams as $team) {
            (new \App\Contender([
                'pool_id' => $firstpoolStage1,
                'team_id' => $team->id
            ]))->save();
        }
        $firstcontender = \App\Contender::where('pool_id', '=', $firstpoolStage1)->first()->id;

        $firstcourt = \App\Court::where('sport_id', '=', $sportid)->first()->id;

        $teams = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12); // Offsets from database id of first contender

        $nbTeams = count($teams);
        $evenNumberOfTeams = ($nbTeams % 2 == 0); // it matters....

        // There will be N-1 rounds (each team will play N-1 games) if the number of teams is even,
        // N rounds if it is odd: each team will play N-1 games and rest during one round
        // Build an array so that it's easy to later define rounds in a richer way than just a number
        $rounds = array();
        for ($i = 0; $i < $nbTeams - 1; $i++) $rounds[] = $i + 1;
        if (!$evenNumberOfTeams) $rounds[] = $i + 1;

        $timeoffset = 0; // in minutes

        // Ok, let's generate...
        foreach ($rounds as $round) {
            $poolHour = 13 + intdiv($timeoffset, 60);
            $poolMinute = $timeoffset % 60;

            $team1Index = 1;
            $team2Index = $evenNumberOfTeams ? $nbTeams - 2 : $nbTeams - 1;
            // "draw the horizontal lines in the polygon", leaving the first team out
            while ($team1Index < $team2Index) {
                (new \App\Game(['date' => '2018-07-03', 'start_time' => "$poolHour:$poolMinute", 'contender1_id' => $firstcontender + $teams[$team1Index], 'contender2_id' => $firstcontender + $teams[$team2Index], 'court_id' => $firstcourt]))->save();
                $team1Index++;
                $team2Index--;
            }
            // One extra game for the first and last teams
            if ($evenNumberOfTeams) echo "Game: {$teams[0]} vs {$teams[$nbTeams - 1]}<br>";

            // prepare for next round
            $teams = $this->rotate($teams);
            $timeoffset += 15;
        }
    }

    private function rotate($arr)
    // return the array rotated by one slot. If the number of elements is even, the last item is kept out of the rotation
    {
        $lastIndex = (count($arr) % 2 == 0) ? count($arr) - 2 : count($arr) - 1;
        $first = $arr[0];
        for ($i = 0; $i < $lastIndex; $i++) $arr[$i] = $arr[$i + 1];
        $arr[$lastIndex] = $first;
        return $arr;
    }

    private function UniHockey()
    {
        echo "Unihockey\n";
        $bv = \App\Tournament::where('name', 'like', '%hockey%')->first();
        if (!$bv) {
            echo "Le tournoi de unihockey n'existe pas\n";
            return;
        }
        $tournamentid = $bv->id;
        $sportid = $bv->sport_id;

        $teams = \App\Team::where('tournament_id', '=', $tournamentid)->get();

        echo "Tournoi #$tournamentid, " . $teams->count() . " équipes inscrites\n";
        //================================================================================================================
        echo "Championnat\n";

        $pool = new \App\Pool([
            'tournament_id' => $tournamentid,
            'start_time' => '09:30',
            'end_time' => '16:00',
            'poolName' => 'The Championship',
            'mode_id' => 1,
            'game_type_id' => 1,
            'poolSize' => 8,
            'stage' => 1,
            'isFinished' => 0
        ]);
        $pool->save();
        $firstpoolStage1 = $pool->id; // we'll need that to put teams into pools


        foreach ($teams as $team) {
            (new \App\Contender([
                'pool_id' => $firstpoolStage1,
                'team_id' => $team->id
            ]))->save();
        }
        $firstcontender = \App\Contender::where('pool_id', '=', $firstpoolStage1)->first()->id;

        $firstcourt = \App\Court::where('sport_id', '=', $sportid)->first()->id;

        // Thank you https://nrich.maths.org/1443
        // Games of pool A
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '09:30', 'contender1_id' => $firstcontender + 6, 'contender2_id' => $firstcontender + 5, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '09:30', 'contender1_id' => $firstcontender + 0, 'contender2_id' => $firstcontender + 4, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '09:51', 'contender1_id' => $firstcontender + 1, 'contender2_id' => $firstcontender + 3, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '09:51', 'contender1_id' => $firstcontender + 5, 'contender2_id' => $firstcontender + 4, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:12', 'contender1_id' => $firstcontender + 6, 'contender2_id' => $firstcontender + 3, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:12', 'contender1_id' => $firstcontender + 0, 'contender2_id' => $firstcontender + 2, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:33', 'contender1_id' => $firstcontender + 4, 'contender2_id' => $firstcontender + 3, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:33', 'contender1_id' => $firstcontender + 5, 'contender2_id' => $firstcontender + 2, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:54', 'contender1_id' => $firstcontender + 6, 'contender2_id' => $firstcontender + 1, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:54', 'contender1_id' => $firstcontender + 3, 'contender2_id' => $firstcontender + 2, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '11:15', 'contender1_id' => $firstcontender + 4, 'contender2_id' => $firstcontender + 1, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '11:15', 'contender1_id' => $firstcontender + 5, 'contender2_id' => $firstcontender + 0, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:00', 'contender1_id' => $firstcontender + 2, 'contender2_id' => $firstcontender + 1, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:00', 'contender1_id' => $firstcontender + 3, 'contender2_id' => $firstcontender + 0, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:21', 'contender1_id' => $firstcontender + 4, 'contender2_id' => $firstcontender + 6, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:21', 'contender1_id' => $firstcontender + 1, 'contender2_id' => $firstcontender + 0, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:42', 'contender1_id' => $firstcontender + 2, 'contender2_id' => $firstcontender + 6, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:42', 'contender1_id' => $firstcontender + 3, 'contender2_id' => $firstcontender + 5, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '15:03', 'contender1_id' => $firstcontender + 0, 'contender2_id' => $firstcontender + 6, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '15:03', 'contender1_id' => $firstcontender + 1, 'contender2_id' => $firstcontender + 5, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '15:24', 'contender1_id' => $firstcontender + 2, 'contender2_id' => $firstcontender + 4, 'court_id' => $firstcourt]))->save();
    }

    private function Basket()
    {
        echo "Basket\n";
        $bv = \App\Tournament::where('name', 'like', '%Basket%')->first();
        if (!$bv) {
            echo "Le tournoi de basket n'existe pas\n";
            return;
        }
        $tournamentid = $bv->id;
        $sportid = $bv->sport_id;

        $teams = \App\Team::where('tournament_id', '=', $tournamentid)->get();

        echo "Tournoi #$tournamentid, " . $teams->count() . " équipes inscrites\n";
        //================================================================================================================
        echo "Championnat\n";

        $pool = new \App\Pool([
            'tournament_id' => $tournamentid,
            'start_time' => '09:30',
            'end_time' => '16:00',
            'poolName' => 'NBA',
            'mode_id' => 1,
            'game_type_id' => 1,
            'poolSize' => 8,
            'stage' => 1,
            'isFinished' => 0
        ]);
        $pool->save();
        $firstpoolStage1 = $pool->id; // we'll need that to put teams into pools


        foreach ($teams as $team) {
            (new \App\Contender([
                'pool_id' => $firstpoolStage1,
                'team_id' => $team->id
            ]))->save();
        }
        $firstcontender = \App\Contender::where('pool_id', '=', $firstpoolStage1)->first()->id;

        $firstcourt = \App\Court::where('sport_id', '=', $sportid)->first()->id;

        // Thank you https://nrich.maths.org/1443
        // Games of pool A
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '09:30', 'contender1_id' => $firstcontender + 6, 'contender2_id' => $firstcontender + 5, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '09:47', 'contender1_id' => $firstcontender + 0, 'contender2_id' => $firstcontender + 4, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:04', 'contender1_id' => $firstcontender + 1, 'contender2_id' => $firstcontender + 3, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:21', 'contender1_id' => $firstcontender + 2, 'contender2_id' => $firstcontender + 7, 'court_id' => $firstcourt]))->save();

        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:38', 'contender1_id' => $firstcontender + 5, 'contender2_id' => $firstcontender + 4, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:55', 'contender1_id' => $firstcontender + 6, 'contender2_id' => $firstcontender + 3, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '11:12', 'contender1_id' => $firstcontender + 0, 'contender2_id' => $firstcontender + 2, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '11:29', 'contender1_id' => $firstcontender + 1, 'contender2_id' => $firstcontender + 7, 'court_id' => $firstcourt]))->save();

        (new \App\Game(['date' => '2017-06-27', 'start_time' => '11:46', 'contender1_id' => $firstcontender + 4, 'contender2_id' => $firstcontender + 3, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '12:03', 'contender1_id' => $firstcontender + 5, 'contender2_id' => $firstcontender + 2, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '12:20', 'contender1_id' => $firstcontender + 6, 'contender2_id' => $firstcontender + 1, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '12:37', 'contender1_id' => $firstcontender + 0, 'contender2_id' => $firstcontender + 7, 'court_id' => $firstcourt]))->save();

        (new \App\Game(['date' => '2017-06-27', 'start_time' => '12:54', 'contender1_id' => $firstcontender + 3, 'contender2_id' => $firstcontender + 2, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:11', 'contender1_id' => $firstcontender + 4, 'contender2_id' => $firstcontender + 1, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:28', 'contender1_id' => $firstcontender + 5, 'contender2_id' => $firstcontender + 0, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:45', 'contender1_id' => $firstcontender + 6, 'contender2_id' => $firstcontender + 7, 'court_id' => $firstcourt + 1]))->save();

        (new \App\Game(['date' => '2017-06-27', 'start_time' => '14:02', 'contender1_id' => $firstcontender + 2, 'contender2_id' => $firstcontender + 1, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '14:19', 'contender1_id' => $firstcontender + 3, 'contender2_id' => $firstcontender + 0, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '14:36', 'contender1_id' => $firstcontender + 4, 'contender2_id' => $firstcontender + 6, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '14:53', 'contender1_id' => $firstcontender + 5, 'contender2_id' => $firstcontender + 7, 'court_id' => $firstcourt + 1]))->save();

        (new \App\Game(['date' => '2017-06-27', 'start_time' => '15:10', 'contender1_id' => $firstcontender + 1, 'contender2_id' => $firstcontender + 0, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '15:27', 'contender1_id' => $firstcontender + 2, 'contender2_id' => $firstcontender + 6, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '15:44', 'contender1_id' => $firstcontender + 3, 'contender2_id' => $firstcontender + 5, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '16:01', 'contender1_id' => $firstcontender + 4, 'contender2_id' => $firstcontender + 7, 'court_id' => $firstcourt + 1]))->save();

        (new \App\Game(['date' => '2017-06-27', 'start_time' => '16:18', 'contender1_id' => $firstcontender + 0, 'contender2_id' => $firstcontender + 6, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '16:35', 'contender1_id' => $firstcontender + 1, 'contender2_id' => $firstcontender + 5, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '16:52', 'contender1_id' => $firstcontender + 2, 'contender2_id' => $firstcontender + 4, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '17:09', 'contender1_id' => $firstcontender + 3, 'contender2_id' => $firstcontender + 7, 'court_id' => $firstcourt + 1]))->save();
    }

    private function BeachVolley()
    {
        echo "Beach Volley\n";
        $bv = \App\Tournament::where('name', 'like', '%Beach%')->first();
        if (!$bv) {
            echo "Le tournoi de beach n'existe pas\n";
            return;
        }
        $tournamentid = $bv->id;
        $sportid = $bv->sport_id;

        $teams = \App\Team::where('tournament_id', '=', $tournamentid)->get();

        echo "Tournoi #$tournamentid, " . $teams->count() . " équipes inscrites\n";
        //================================================================================================================
        echo "Stage 1 = 2 poules de 6 équipes\n";

        $pool = new \App\Pool([
            'tournament_id' => $tournamentid,
            'start_time' => '09:30',
            'end_time' => '11:45',
            'poolName' => 'A',
            'mode_id' => 1,
            'game_type_id' => 1,
            'poolSize' => 6,
            'stage' => 1,
            'isFinished' => 0
        ]);
        $pool->save();
        $firstpoolStage1 = $pool->id; // we'll need that to put teams into pools

        (new \App\Pool([
            'tournament_id' => $tournamentid,
            'start_time' => '09:30',
            'end_time' => '11:45',
            'poolName' => 'B',
            'mode_id' => 1,
            'game_type_id' => 1,
            'poolSize' => 6,
            'stage' => 1,
            'isFinished' => 0
        ]))->save();

        $nbTeams = 0;
        foreach ($teams as $team) {
            (new \App\Contender([
                'pool_id' => $firstpoolStage1 + intdiv($nbTeams, 6),
                'team_id' => $team->id
            ]))->save();
            $nbTeams++;
        }
        $firstcontender = \App\Contender::where('pool_id', '=', $firstpoolStage1)->first()->id;
        $firstcourt = \App\Court::where('sport_id', '=', $sportid)->first()->id;

        // Games of pool A
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '09:30', 'contender1_id' => $firstcontender + 0, 'contender2_id' => $firstcontender + 1, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '09:40', 'contender1_id' => $firstcontender + 2, 'contender2_id' => $firstcontender + 3, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '09:50', 'contender1_id' => $firstcontender + 3, 'contender2_id' => $firstcontender + 5, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:00', 'contender1_id' => $firstcontender + 0, 'contender2_id' => $firstcontender + 2, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:10', 'contender1_id' => $firstcontender + 3, 'contender2_id' => $firstcontender + 4, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:20', 'contender1_id' => $firstcontender + 1, 'contender2_id' => $firstcontender + 5, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:30', 'contender1_id' => $firstcontender + 0, 'contender2_id' => $firstcontender + 3, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:40', 'contender1_id' => $firstcontender + 1, 'contender2_id' => $firstcontender + 4, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:50', 'contender1_id' => $firstcontender + 2, 'contender2_id' => $firstcontender + 5, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '11:00', 'contender1_id' => $firstcontender + 0, 'contender2_id' => $firstcontender + 4, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '11:10', 'contender1_id' => $firstcontender + 1, 'contender2_id' => $firstcontender + 2, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '11:20', 'contender1_id' => $firstcontender + 3, 'contender2_id' => $firstcontender + 5, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '11:30', 'contender1_id' => $firstcontender + 0, 'contender2_id' => $firstcontender + 5, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '11:40', 'contender1_id' => $firstcontender + 1, 'contender2_id' => $firstcontender + 3, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '11:50', 'contender1_id' => $firstcontender + 2, 'contender2_id' => $firstcontender + 4, 'court_id' => $firstcourt]))->save();

        // Games of pool B
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '09:30', 'contender1_id' => $firstcontender + 6, 'contender2_id' => $firstcontender + 7, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '09:40', 'contender1_id' => $firstcontender + 8, 'contender2_id' => $firstcontender + 9, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '09:50', 'contender1_id' => $firstcontender + 9, 'contender2_id' => $firstcontender + 11, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:00', 'contender1_id' => $firstcontender + 6, 'contender2_id' => $firstcontender + 8, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:10', 'contender1_id' => $firstcontender + 9, 'contender2_id' => $firstcontender + 10, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:20', 'contender1_id' => $firstcontender + 7, 'contender2_id' => $firstcontender + 11, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:30', 'contender1_id' => $firstcontender + 6, 'contender2_id' => $firstcontender + 9, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:40', 'contender1_id' => $firstcontender + 7, 'contender2_id' => $firstcontender + 6, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '10:50', 'contender1_id' => $firstcontender + 8, 'contender2_id' => $firstcontender + 11, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '11:00', 'contender1_id' => $firstcontender + 6, 'contender2_id' => $firstcontender + 10, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '11:10', 'contender1_id' => $firstcontender + 7, 'contender2_id' => $firstcontender + 8, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '11:20', 'contender1_id' => $firstcontender + 9, 'contender2_id' => $firstcontender + 11, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '11:30', 'contender1_id' => $firstcontender + 6, 'contender2_id' => $firstcontender + 11, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '11:40', 'contender1_id' => $firstcontender + 7, 'contender2_id' => $firstcontender + 9, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '11:50', 'contender1_id' => $firstcontender + 8, 'contender2_id' => $firstcontender + 10, 'court_id' => $firstcourt + 1]))->save();

        //================================================================================================================
        echo "Stage 2 = 2 poules de 6 équipes\n";

        $pool = new \App\Pool([
            'tournament_id' => $tournamentid,
            'start_time' => '09:30',
            'end_time' => '11:45',
            'poolName' => 'Winners',
            'mode_id' => 1,
            'game_type_id' => 1,
            'poolSize' => 6,
            'stage' => 2,
            'isFinished' => 0
        ]);
        $pool->save();
        $firstpoolStage2 = $pool->id; // we'll need that to put teams into pools

        (new \App\Pool([
            'tournament_id' => $tournamentid,
            'start_time' => '09:30',
            'end_time' => '11:45',
            'poolName' => 'Cool',
            'mode_id' => 1,
            'game_type_id' => 1,
            'poolSize' => 6,
            'stage' => 2,
            'isFinished' => 0
        ]))->save();

        (new \App\Contender(['pool_id' => $firstpoolStage2, 'pool_from_id' => $firstpoolStage1, 'rank_in_pool' => 1]))->save();
        (new \App\Contender(['pool_id' => $firstpoolStage2, 'pool_from_id' => $firstpoolStage1, 'rank_in_pool' => 2]))->save();
        (new \App\Contender(['pool_id' => $firstpoolStage2, 'pool_from_id' => $firstpoolStage1, 'rank_in_pool' => 3]))->save();
        (new \App\Contender(['pool_id' => $firstpoolStage2, 'pool_from_id' => $firstpoolStage1 + 1, 'rank_in_pool' => 1]))->save();
        (new \App\Contender(['pool_id' => $firstpoolStage2, 'pool_from_id' => $firstpoolStage1 + 1, 'rank_in_pool' => 2]))->save();
        (new \App\Contender(['pool_id' => $firstpoolStage2, 'pool_from_id' => $firstpoolStage1 + 1, 'rank_in_pool' => 3]))->save();

        (new \App\Contender(['pool_id' => $firstpoolStage2 + 1, 'pool_from_id' => $firstpoolStage1, 'rank_in_pool' => 4]))->save();
        (new \App\Contender(['pool_id' => $firstpoolStage2 + 1, 'pool_from_id' => $firstpoolStage1, 'rank_in_pool' => 5]))->save();
        (new \App\Contender(['pool_id' => $firstpoolStage2 + 1, 'pool_from_id' => $firstpoolStage1, 'rank_in_pool' => 6]))->save();
        (new \App\Contender(['pool_id' => $firstpoolStage2 + 1, 'pool_from_id' => $firstpoolStage1 + 1, 'rank_in_pool' => 4]))->save();
        (new \App\Contender(['pool_id' => $firstpoolStage2 + 1, 'pool_from_id' => $firstpoolStage1 + 1, 'rank_in_pool' => 5]))->save();
        (new \App\Contender(['pool_id' => $firstpoolStage2 + 1, 'pool_from_id' => $firstpoolStage1 + 1, 'rank_in_pool' => 6]))->save();

        $firstcontender = \App\Contender::where('pool_id', '=', $firstpoolStage2)->first()->id;
        $firstcourt = \App\Court::where('sport_id', '=', $sportid)->first()->id;

        // Games of pool Winner
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:00', 'contender1_id' => $firstcontender + 0, 'contender2_id' => $firstcontender + 1, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:10', 'contender1_id' => $firstcontender + 2, 'contender2_id' => $firstcontender + 3, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:20', 'contender1_id' => $firstcontender + 3, 'contender2_id' => $firstcontender + 5, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:30', 'contender1_id' => $firstcontender + 0, 'contender2_id' => $firstcontender + 2, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:40', 'contender1_id' => $firstcontender + 3, 'contender2_id' => $firstcontender + 4, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:50', 'contender1_id' => $firstcontender + 1, 'contender2_id' => $firstcontender + 5, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '14:00', 'contender1_id' => $firstcontender + 0, 'contender2_id' => $firstcontender + 3, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '14:10', 'contender1_id' => $firstcontender + 1, 'contender2_id' => $firstcontender + 4, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '14:20', 'contender1_id' => $firstcontender + 2, 'contender2_id' => $firstcontender + 5, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '14:30', 'contender1_id' => $firstcontender + 0, 'contender2_id' => $firstcontender + 4, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '14:40', 'contender1_id' => $firstcontender + 1, 'contender2_id' => $firstcontender + 2, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '14:50', 'contender1_id' => $firstcontender + 3, 'contender2_id' => $firstcontender + 5, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '15:00', 'contender1_id' => $firstcontender + 0, 'contender2_id' => $firstcontender + 5, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '15:10', 'contender1_id' => $firstcontender + 1, 'contender2_id' => $firstcontender + 3, 'court_id' => $firstcourt]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '15:20', 'contender1_id' => $firstcontender + 2, 'contender2_id' => $firstcontender + 4, 'court_id' => $firstcourt]))->save();

        // Games of pool Losers
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:00', 'contender1_id' => $firstcontender + 6, 'contender2_id' => $firstcontender + 7, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:10', 'contender1_id' => $firstcontender + 8, 'contender2_id' => $firstcontender + 9, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:20', 'contender1_id' => $firstcontender + 9, 'contender2_id' => $firstcontender + 11, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:30', 'contender1_id' => $firstcontender + 6, 'contender2_id' => $firstcontender + 8, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:40', 'contender1_id' => $firstcontender + 9, 'contender2_id' => $firstcontender + 10, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '13:50', 'contender1_id' => $firstcontender + 7, 'contender2_id' => $firstcontender + 11, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '14:00', 'contender1_id' => $firstcontender + 6, 'contender2_id' => $firstcontender + 9, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '14:10', 'contender1_id' => $firstcontender + 7, 'contender2_id' => $firstcontender + 6, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '14:20', 'contender1_id' => $firstcontender + 8, 'contender2_id' => $firstcontender + 11, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '14:30', 'contender1_id' => $firstcontender + 6, 'contender2_id' => $firstcontender + 10, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '14:40', 'contender1_id' => $firstcontender + 7, 'contender2_id' => $firstcontender + 8, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '14:50', 'contender1_id' => $firstcontender + 9, 'contender2_id' => $firstcontender + 11, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '15:00', 'contender1_id' => $firstcontender + 6, 'contender2_id' => $firstcontender + 11, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '15:10', 'contender1_id' => $firstcontender + 7, 'contender2_id' => $firstcontender + 9, 'court_id' => $firstcourt + 1]))->save();
        (new \App\Game(['date' => '2017-06-27', 'start_time' => '15:20', 'contender1_id' => $firstcontender + 8, 'contender2_id' => $firstcontender + 10, 'court_id' => $firstcourt + 1]))->save();
    }
}
