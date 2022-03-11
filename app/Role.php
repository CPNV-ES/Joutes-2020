<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

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

    public function getUsers(){
        return $this->hasMany(User::class, 'roles_id');
    }

    public function isUsed(){
        return DB::table('users')->where('role_id', $this->id)->exists();
    }
}
