<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    public $timestamps = false;
    protected $fillable = array('name', 'description','max_participant','min_participant'); // -> We have to define all data we use on our sport table (For use ->all())


    public function courts()
    {
        return $this->hasMany(Court::class);
    }

    public function tournaments()
    {
		return $this->hasMany('App\Tournament');
	}
}

