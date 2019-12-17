<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    protected $fillable = ['slug', 'name'];


    public function getSlug(){
        return $this->slug;
    }

    public function getName(){
        return $this->name;
    }


    public function users(){
        return $this->hasMany('App\User', 'roles_id');
    }
}
