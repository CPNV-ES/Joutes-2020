<?php

namespace App;

use App\User;
use App\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Engagement extends Model
{
    use HasFactory;
    public $timestamps = false;

    public static function findBySlug(string $slug): self
    {
        return self::where('slug', $slug)->firstOrFail();
    }

    public static function findByEventAndUser(Event $event, User $user)
    {
        return self::find($event->user($user)->pivot->engagement_id);
    }
}
