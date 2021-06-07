<?php


namespace App\Enums;


abstract class EventState
{
    const Prep = 0;
    const Register = 1;
    const Ready = 2;
    const Finished = 3;

    public static function eventStateName($eventState)
    {
        switch ($eventState) {
            case self::Prep:
                return "En Préparation";
            case self::Register:
                return "Inscription";
            case self::Ready:
                return "En cours";
            case self::Finished:
                return "Terminé";
            default:
                return "inconnu";
        }
    }
}
