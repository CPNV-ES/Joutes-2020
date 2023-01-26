<?php

namespace App\Helpers;

use App\Models\Contender;
use App\Models\Pool;

class ContenderHelper
{
  public static function contenderDisplayName(Contender $contender)
  {
    if ($contender->team) {
      return $contender->team->name;
    } elseif(isset($contender->fromPool->poolName)) {
      return $contender->rank_in_pool.' de '.$contender->fromPool->poolName;
    }
  }
  public static function isSelected (Pool $pool, $teamId, $poolId)
  {
      return $pool->whereHas('contenders',function ($q) use ($poolId, $teamId) {
          $q->where('team_id', $teamId)
              ->where('pool_from_id', $poolId);
      })->count();
  }

  public static function isPoolClosed(Contender $contender)
  {
    return Pool::find($contender->pool_from_id)->poolState == 3;
  }
}
