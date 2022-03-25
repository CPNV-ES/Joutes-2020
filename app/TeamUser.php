<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamUser extends Model
{
    use HasFactory;
    public $fillable = ['user_id','team_id','isCaptain'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public static function newCapitain($members,$user)
    {
        foreach ($members as $member){
            $member->isCaptain = 0;
            $member->save();
        }
        $chosen = TeamUser::firstWhere('user_id', $user->id);
        $chosen->isCaptain = 1;
        return $chosen->save();
    }


}
