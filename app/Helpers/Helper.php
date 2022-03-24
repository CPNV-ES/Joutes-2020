<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\User;
use App\Event;
use App\EventRoleUser;
use App\Enums\EventState;

class Helper
{
    /**
     * Get EventRoleUser by $user and $event
     *
     * @param User $user
     * @param Event $event
     * @return void
     */
    public static function eventRoleUser(User $user, Event $event)
    {
        return EventRoleUser::findByEventAndEvent($user, $event);
    }

    /**
     * Get state name by ID (INT)
     *
     * @param integer $state
     * @return void
     */
    public static function eventStateName(int $state)
    {
        return EventState::eventStateName($state);
    }
}
