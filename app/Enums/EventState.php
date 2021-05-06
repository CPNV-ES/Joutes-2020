<?php


namespace App\Enums;


abstract class EventState
{
    const Close = 0;
    const Activate = 1;

    public static function poolStateName($poolState)
    {
        switch ($poolState) {
            case self::Close:
                return "Fermée";
            case self::Activate:
                return "Activée";
            default:
                return "inconnu";
        }
    }
}
