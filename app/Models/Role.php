<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    public $timestamps = false;

    protected $fillable = ['slug', 'name'];

    public function getSlug()
    {
        return $this->slug;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUsers()
    {
        return $this->hasMany('App\Models\User', 'roles_id');
    }

    public function isUsed()
    {
        return DB::table('users')->where('role_id', $this->id)->exists();
    }

    public static function availableForEngagement()
    {
        return self::where('slug', 'PART')->orWhere('slug', 'GEST');
    }

    public static function findBySlug(string $slug)
    {
        return self::firstWhere('slug', $slug);
    }
}
