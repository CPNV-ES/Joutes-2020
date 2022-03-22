<?php

namespace App;

use App\Role;
use App\User;
use App\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventRoleUser extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['role_id', 'user_id', 'event_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'event_role_user';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public static function findByEventAndEvent(User $user, Event $event)
    {
        return self::firstWhere([
            ['user_id', $user->id],
            ['event_id', $event->id]
        ]);
    }
}
