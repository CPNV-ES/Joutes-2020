<?php

namespace App\Helpers;

use App\User;
use App\Event;
use App\Engagement;

class EventHelper
{
    public static function displayUserRoleByEvent(Event $event, User $user)
    {
        return Engagement::findByEventAndUser($event, $user)->name;
    }
}
