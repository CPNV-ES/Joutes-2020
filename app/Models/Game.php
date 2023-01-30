<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $timestamps = false;
    protected $fillable = array('score_contender1', 'score_contender2', 'date', 'start_time', 'contender1_id', 'contender2_id', 'court_id');

    public function contender1()
    {
        return $this->belongsTo(Contender::class, 'contender1_id');
    }

    public function contender2()
    {
        return $this->belongsTo(Contender::class, 'contender2_id');
    }

    public function pool()
    {
        return $this->contender1->pool;
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function team1()
    {
        return $this->contender1->team;
    }

    public function team2()
    {
        return $this->contender2->team;
    }
    //return boolean if next this game as no score and next game start time is after actual time
    public function isLate()
    {
        $nextGame = $this->nextGame();
        if ($nextGame == null) {
            return false;
        }
        //if next game start time is after actual time
        else if ($nextGame->start_time > date('Y-m-d H:i:s')) {
            return false;
        }
        return true;
    }

    //get next game of the same pool and same stage
    public function nextGame()
    {
        $nextGame = Game::where('court_id', '=', $this->court()->get()->toArray()[0]['id'])->where(
            'start_time',
            '>',
            $this->start_time
        )->orderBy('date')->orderBy('start_time')->first();
        return $nextGame;
    }
}
