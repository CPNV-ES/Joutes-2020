<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoolMode extends Model
{
    const SINGLE_ELIMINATION = 1;
    const DOUBLE_ELIMINATION = 2;
    const DIRECT_ELIMINATION = 3;

    public $timestamps = false;
}
