<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contender extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'pool_id', 'team_id', 'rank_in_pool', 'pool_from_id'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function fromPool(){
        return $this->belongsTo('App\Pool', 'pool_from_id');
    }

    public function pool() {
        return $this->belongsTo(Pool::class, 'pool_id');
    }

    public function alreadyInserted() {
        return DB::table('contenders')
            ->where('rank_in_pool', '=', $this->rank_in_pool)
            ->where('pool_id', '=', $this->pool_id)
            ->where('pool_from_id', '=', $this->pool_from_id)->exists();
    }

    public function previousId() {
      if ($this->team_id) {
        return $this->team_id;
      }

      return $this->pool_from_id.'-'.$this->rank_in_pool;
    }

}
