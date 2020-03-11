<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pool extends Model
{
    public $timestamps = false;

    public function contenders()
    {
        return $this->hasMany(Contender::class);
    }

    public function games(){
        return $this->hasManyThrough(Game::class, Contender::class, 'pool_id', 'contender1_id');
    }


    public function rankings() {
        $teams = $this->teams();
        $games = $this->games;

        $rankings = array();
        foreach ($games as $game) {
            if (empty($game->contender1_id)) {



                // Create the implicite name
                $impliciteContender1Name = $game->contender1->rank_in_pool . ($game->contender1->rank_in_pool == 1 ? "er " : 'ème ') . "de " . $game->contender1->fromPool->poolName;


                $contender1exists = false;

                // detect if we already have this name
                for ($i=0; $i < sizeof($rankings); $i++) {
                    if($rankings[$i]['team'] == $impliciteContender1Name){
                        $contender1exists = true;
                    }
                }


                // Add on the rankings array
                if(!$contender1exists){
                    $rankings[] = array(
                        "team_id" 	=> -1,
                        "team" 		=> $impliciteContender1Name,
                        "score" 	=> 0,
                        "W" 		=> 0,
                        "L" 		=> 0,
                        "D" 		=> 0,
                        "+-" 		=> 0
                    );
                }
            }

            if (empty($game->contender2->team)) {
                // Create the implicite name
                $impliciteContender2Name = $game->contender2->rank_in_pool . ($game->contender2->rank_in_pool == 1 ? "er " : 'ème ') . "de " . $game->contender2->fromPool->poolName;
                $contender2exists = false;

                for ($i=0; $i < sizeof($rankings); $i++) {
                    if($rankings[$i]['team'] == $impliciteContender2Name){
                        $contender2exists = true;
                    }
                }

                if(!$contender2exists){
                    $rankings[] = array(
                        "team_id" 	=> -1,
                        "team" 		=> $impliciteContender2Name,
                        "score" 	=> 0,
                        "W" 		=> 0,
                        "L"	 		=> 0,
                        "D"			=> 0,
                        "+-" 		=> 0
                    );
                }
            }


            if (!empty($teams)) {
                foreach ($teams as $id => $team) {
                    $score 		 = 0;
                    $win 		 = 0;
                    $loose       = 0;
                    $draw 	     = 0;
                    $goalBalance = 0;


                    $position = -1;
                    // check if team is already in ranking
                    foreach ($rankings as $key => $ranking) {
                        if ($ranking["team_id"] == $id) {
                            $position = $key;
                            break;
                        }
                    }
                    // if so get old ranking values
                    if ($position != -1) {
                        $score 			= $rankings[$position]["score"];
                        $win 			= $rankings[$position]["W"];
                        $loose 			= $rankings[$position]["L"];
                        $draw 			= $rankings[$position]["D"];
                        $goalBalance 	= $rankings[$position]["+-"];
                    }


                    if ((!empty($game->score_contender1) || !empty($game->score_contender2)) && !empty($game->contender1->team) && !empty($game->contender2->team)) {
                        if($game->contender1->team->name == $team || $game->contender2->team->name == $team) {
                            // $team had a draw
                            if($game->score_contender1 == $game->score_contender2) {
                                $score += 1;
                                $draw++;
                            }
                            // $team won the game
                            else if($game->score_contender1 > $game->score_contender2 && $game->contender1->team->name == $team ||
                                $game->score_contender2 > $game->score_contender1 && $game->contender2->team->name == $team) {
                                $score += 2;
                                $win++;
                            }
                            // $team lost the game
                            else {
                                $loose++;
                            }

                            // calcul the balance between goal+ ($team) and goal- (contender)
                            if($game->contender1->team->name == $team) {
                                $goalBalance += $game->score_contender1;
                                $goalBalance -= $game->score_contender2;
                            }
                            else if($game->contender2->team->name == $team) {
                                $goalBalance += $game->score_contender2;
                                $goalBalance -= $game->score_contender1;
                            }
                        }
                    }

                    if ($position == -1) {
                        $rankings[] = array(
                            "team_id" 	=> $id,
                            "team" 		=> $team,
                            "score" 	=> $score,
                            "W" 		=> $win,
                            "L" 		=> $loose,
                            "D" 		=> $draw,
                            "+-" 		=> $goalBalance
                        );
                    }
                    else {
                        $rankings[$position] = array(
                            "team_id" 	=> $id,
                            "team" 		=> $team,
                            "score" 	=> $score,
                            "W" 		=> $win,
                            "L" 		=> $loose,
                            "D" 		=> $draw,
                            "+-" 		=> $goalBalance
                        );
                    }
                }
            }
        }

        return $this->sort($rankings);
    }

    private function teams(){
        $teams = array();
        foreach ($this->games as $game) {
            if(!empty($game->contender1->team)){
                $teams[$game->contender1->team->id] = $game->contender1->team->name;
            }
            if(!empty($game->contender2->team)){
                $teams[$game->contender2->team->id] = $game->contender2->team->name;
            }
        }
        return $teams;
    }

    private function sort($rankings_row){
        $rankings_sort = array();
        foreach($rankings_row as $key=>$value) {
            $rankings_sort['score'][$key] = $value['score'];
            $rankings_sort['+-'][$key] = $value['+-'];
        }

        array_multisort($rankings_sort['score'], SORT_DESC, $rankings_sort['+-'], SORT_DESC, $rankings_row);

        return $rankings_row;
    }

    public function isEditable(){
        if(Auth::check()){
            $role = Auth::user()->role;
            if($role == "writer" || $role == "administrator") return ($this->isFinished == 0);
        }
        return false;
    }

}
