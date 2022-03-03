<?php

namespace Database\Seeders\fakes;

use App\Role;
use App\Team;
use App\GameType;
use Carbon\Carbon;
use App\Tournament;
use Illuminate\Database\Seeder;

class Joutes2022Seeder extends Seeder
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

        $this->event = \App\Event::where('name', 'like', '%2019%')->first();
        if ($this->event) die("L'événement existe déjà\n");

        $this->event = new \App\Event(['name' => 'Joutes 2019', 'img' => 'joutes.jpg', 'eventState' => 0]);
        $this->event->save();

        // make room
        \Illuminate\Support\Facades\DB::statement('delete from games;');
        \Illuminate\Support\Facades\DB::statement('delete from contenders;');
        \Illuminate\Support\Facades\DB::statement('delete from pools;');

        $this->tournamentsList();
        $this->teams();
        $this->BeachVolley();
        $this->Basket();
        $this->UniHockey();
        $this->Badminton();
    }

    // Common stuff


    // Create (empty) tournaments
    private function tournamentsList()
    {
        echo "Création du tournoi de beach...";
        // Beach Volley

        $sport = \App\Sport::where('name', 'like', '%Beach%')->first();
        $tournament = new \App\Tournament(['name' => 'Beach Volley', 'start_date' => Carbon::Parse('2019-07-02 08:00'), 'end_date' => Carbon::Parse('2019-07-02 16:00'), 'max_teams' => 12, 'img' => 'beachvolley.jpg']);
        echo ("-");
        $tournament->sport()->associate($sport);
        echo ("-");
        $tournament->event()->associate($this->event);
        echo ("-");
        $tournament->save();
        echo "OK\n";

        echo "Création du tournoi de badminton...";
        // Bad
        $sport = \App\Sport::where('name', 'like', '%Badminton%')->first();
        $tournament = new \App\Tournament(['name' => 'Badminton', 'start_date' => Carbon::Parse('2019-07-02 13:30'), 'end_date' => Carbon::Parse('2019-07-02 16:00'), 'max_teams' => 16, 'img' => 'badminton.jpg']);
        $tournament->sport()->associate($sport);
        $tournament->event()->associate($this->event);
        $tournament->save();
        echo "OK\n";

        echo "Création du tournoi de basket...";
        // Basket
        $sport = \App\Sport::where('name', 'like', '%Basket%')->first();
        $tournament = new \App\Tournament(['name' => 'Basket', 'start_date' => Carbon::Parse('2019-07-02 08:00'), 'end_date' => Carbon::Parse('2019-07-02 12:00'), 'max_teams' => 10, 'img' => 'basket.jpg']);
        $tournament->sport()->associate($sport);
        $tournament->event()->associate($this->event);
        $tournament->save();
        echo "OK\n";

        echo "Création du tournoi de unihockey...";
        // Unihockey
        $sport = \App\Sport::where('name', 'like', '%Unihockey%')->first();
        $tournament = new \App\Tournament(['name' => 'Unihockey', 'start_date' => Carbon::Parse('2019-07-02 08:00'), 'end_date' => Carbon::Parse('2019-07-02 12:00'), 'max_teams' => 10, 'img' => 'unihockey.jpg']);
        $tournament->sport()->associate($sport);
        $tournament->event()->associate($this->event);
        $tournament->save();
        echo "OK\n";

        echo "Création du tournoi de pétanque...";
        // Pétanque
        $sport = \App\Sport::where('name', 'like', '%Pétanque%')->first();
        $tournament = new \App\Tournament(['name' => 'Pétanque', 'start_date' => Carbon::Parse('2019-07-02 08:00'), 'end_date' => Carbon::Parse('2019-07-02 16:00'), 'max_teams' => 16, 'img' => 'petanque.jpg']);
        $tournament->sport()->associate($sport);
        $tournament->event()->associate($this->event);
        $tournament->save();
        echo "OK\n";

        echo "Création du tournoi de foot...";
        // Foot
        $sport = \App\Sport::where('name', 'like', '%Foot%')->first();
        $tournament = new \App\Tournament(['name' => 'Foot', 'start_date' => Carbon::Parse('2019-07-02 13:30'), 'end_date' => Carbon::Parse('2019-07-02 16:00'), 'max_teams' => 8, 'img' => 'football.jpg']);
        $tournament->sport()->associate($sport);
        $tournament->event()->associate($this->event);
        $tournament->save();
        echo "OK\n";

        echo "Création de la marche...";
        // Marche
        $sport = \App\Sport::where('name', 'like', '%Marche%')->first();
        $tournament = new \App\Tournament(['name' => 'Marche', 'start_date' => Carbon::Parse('2019-07-02 08:00'), 'end_date' => Carbon::Parse('2019-07-02 16:00'), 'max_teams' => 100, 'img' => 'rando.jpg']);
        $tournament->sport()->associate($sport);
        $tournament->event()->associate($this->event);
        $tournament->save();
        echo "OK\n";
    }

    private function teams()
    {
        echo "Création des équipes...";
        echo "\nde badminton";
        $badmintonTournament = Tournament::where('name', 'like', '%Badmin%')->first();

        (new Team(['name' => 'Badboys', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Super Nanas', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'CPVN Crew', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Magical Girls', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'OliverTwist', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Big fat boys', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Minions', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Tchôoo', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Olakétal', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'MAlexandri', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Youpi', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Mouarf', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Soft Dog Meteors', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Volleywood ', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'art-Time Snakes', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Magaical Girls', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'OliverTwist', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Big fat boys', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Minions boys', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Tchôoo men', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Olakétal teammmm', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Dylan gang', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Yakow', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'NotWorking', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Error404', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Super superman', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'CPVN gang', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Magical hood', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'OliverTwinnn', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Big fat girls', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Brrrrrooooo', 'tournament_id' => $badmintonTournament->id]))->save();
        (new Team(['name' => 'Yomen', 'tournament_id' => $badmintonTournament->id]))->save();

        echo "\nde beach volley";
        $beachVolleyTournament = Tournament::where('name', 'like', '%Beach%')->first();

        (new Team(['name' => 'Siomer', 'tournament_id' => $beachVolleyTournament->id]))->save();
        (new Team(['name' => 'Salsadi', 'tournament_id' => $beachVolleyTournament->id]))->save();
        (new Team(['name' => 'Monoster', 'tournament_id' => $beachVolleyTournament->id]))->save();
        (new Team(['name' => 'Picalo', 'tournament_id' => $beachVolleyTournament->id]))->save();
        (new Team(['name' => 'Dellit', 'tournament_id' => $beachVolleyTournament->id]))->save();
        (new Team(['name' => 'Btooom', 'tournament_id' => $beachVolleyTournament->id]))->save();
        (new Team(['name' => 'Stalgia', 'tournament_id' => $beachVolleyTournament->id]))->save();
        (new Team(['name' => 'Clattonia', 'tournament_id' => $beachVolleyTournament->id]))->save();
        (new Team(['name' => 'Danrell', 'tournament_id' => $beachVolleyTournament->id]))->save();
        (new Team(['name' => 'RunAGround', 'tournament_id' => $beachVolleyTournament->id]))->save();
        (new Team(['name' => 'Believer', 'tournament_id' => $beachVolleyTournament->id]))->save();
        (new Team(['name' => 'Plouf', 'tournament_id' => $beachVolleyTournament->id]))->save();

        echo "\nde basket";
        $basketTournament = Tournament::where('name', 'like', '%Basket%')->first();

        (new Team(['name' => 'SuperStar', 'tournament_id' => $basketTournament->id]))->save();
        (new Team(['name' => 'Masting', 'tournament_id' => $basketTournament->id]))->save();
        (new Team(['name' => 'Clafier', 'tournament_id' => $basketTournament->id]))->save();
        (new Team(['name' => 'Robert2Poche', 'tournament_id' => $basketTournament->id]))->save();
        (new Team(['name' => 'Alexandri', 'tournament_id' => $basketTournament->id]))->save();
        (new Team(['name' => 'FanGirls', 'tournament_id' => $basketTournament->id]))->save();
        (new Team(['name' => 'Les Otakus', 'tournament_id' => $basketTournament->id]))->save();
        (new Team(['name' => 'Les Hotoman', 'tournament_id' => $basketTournament->id]))->save();

        echo "\nde UniHockey";
        $uniHockeyTournament = Tournament::where('name', 'like', '%hockey%')->first();

        (new Team(['name' => 'Gamers', 'tournament_id' => $uniHockeyTournament->id]))->save();
        (new Team(['name' => 'Over2000', 'tournament_id' => $uniHockeyTournament->id]))->save();
        (new Team(['name' => 'Shinigami', 'tournament_id' => $uniHockeyTournament->id]))->save();
        (new Team(['name' => 'Rocketteurs', 'tournament_id' => $uniHockeyTournament->id]))->save();
        (new Team(['name' => 'Maya Labeille', 'tournament_id' => $uniHockeyTournament->id]))->save();
        (new Team(['name' => 'Lonvoyant', 'tournament_id' => $uniHockeyTournament->id]))->save();
        (new Team(['name' => 'RoyalGang', 'tournament_id' => $uniHockeyTournament->id]))->save();
        (new Team(['name' => 'The Dwarf', 'tournament_id' => $uniHockeyTournament->id]))->save();
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

        $poolModeId = \App\PoolMode::where('mode_description', '=', 'Matches simples')->get()->first()->id;

        $gameTypeId = GameType::where('game_type_description', '=', 'Modalités de jeu')->get()->first()->id;

        echo "Tournoi #$tournamentid, " . $teams->count() . " équipes inscrites\n";
        //================================================================================================================
        echo "Championnat\n";

        $pool = new \App\Pool([
            'tournament_id' => $tournamentid,
            'start_time' => '09:30',
            'end_time' => '16:00',
            'poolName' => 'The Battle',
            'mode_id' => $poolModeId,
            'game_type_id' => $gameTypeId,
            'poolSize' => 13,
            'stage' => 1,
            'poolState' => 0
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

        // Building the rounds follows the algorithm described here:  https://nrich.maths.org/1443. Thank you Arunachalam Y
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

        $poolModeId = \App\PoolMode::where('mode_description', '=', 'Matches simples')->get()->first()->id;

        $gameTypeId = GameType::where('game_type_description', '=', 'Modalités de jeu')->get()->first()->id;

        echo "Tournoi #$tournamentid, " . $teams->count() . " équipes inscrites\n";
        //================================================================================================================
        echo "Championnat\n";

        $pool = new \App\Pool([
            'tournament_id' => $tournamentid,
            'start_time' => '09:30',
            'end_time' => '16:00',
            'poolName' => 'The Championship',
            'mode_id' => $poolModeId,
            'game_type_id' => $gameTypeId,
            'poolSize' => 8,
            'stage' => 1,
            'poolState' => 0
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

        $poolModeId = \App\PoolMode::where('mode_description', '=', 'Matches simples')->get()->first()->id;

        $gameTypeId = GameType::where('game_type_description', '=', 'Modalités de jeu')->get()->first()->id;

        echo "Tournoi #$tournamentid, " . $teams->count() . " équipes inscrites\n";
        //================================================================================================================
        echo "Championnat\n";

        $pool = new \App\Pool([
            'tournament_id' => $tournamentid,
            'start_time' => '09:30',
            'end_time' => '16:00',
            'poolName' => 'NBA',
            'mode_id' => $poolModeId,
            'game_type_id' => $gameTypeId,
            'poolSize' => 8,
            'stage' => 1,
            'poolState' => 0
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

        $poolModeId = \App\PoolMode::where('mode_description', '=', 'Matches simples')->get()->first()->id;

        $gameTypeId = GameType::where('game_type_description', '=', 'Modalités de jeu')->get()->first()->id;

        echo "Tournoi #$tournamentid, " . $teams->count() . " équipes inscrites\n";
        //================================================================================================================
        echo "Stage 1 = 2 poules de 6 équipes\n";

        $pool = new \App\Pool([
            'tournament_id' => $tournamentid,
            'start_time' => '09:30',
            'end_time' => '11:45',
            'poolName' => 'A',
            'mode_id' => $poolModeId,
            'game_type_id' => $gameTypeId,
            'poolSize' => 6,
            'stage' => 1,
            'poolState' => 0
        ]);
        $pool->save();
        $firstpoolStage1 = $pool->id; // we'll need that to put teams into pools

        (new \App\Pool([
            'tournament_id' => $tournamentid,
            'start_time' => '09:30',
            'end_time' => '11:45',
            'poolName' => 'B',
            'mode_id' => $poolModeId,
            'game_type_id' => 1,
            'poolSize' => 6,
            'stage' => 1,
            'poolState' => 0
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
            'mode_id' => $poolModeId,
            'game_type_id' => 1,
            'poolSize' => 6,
            'stage' => 2,
            'poolState' => 1
        ]);
        $pool->save();
        $firstpoolStage2 = $pool->id; // we'll need that to put teams into pools

        (new \App\Pool([
            'tournament_id' => $tournamentid,
            'start_time' => '09:30',
            'end_time' => '11:45',
            'poolName' => 'Cool',
            'mode_id' => $poolModeId,
            'game_type_id' => 1,
            'poolSize' => 6,
            'stage' => 2,
            'poolState' => 1
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
