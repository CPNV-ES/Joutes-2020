<?php

namespace App\Helpers;

use App\Contender;
use Illuminate\Support\Facades\DB;

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
}