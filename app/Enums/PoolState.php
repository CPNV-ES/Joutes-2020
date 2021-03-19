<?php


namespace App\Enums;


abstract class PoolState
{
    const Prep = 0;
    const Ready = 1;
    const Inprog = 2;
    const Finished = 3;

    public static function poolStateName($poolState)
    {
        switch ($poolState) {
            case self::Prep:
                return "En Préparation";
            case self::Ready:
                return "Prête à débuter";
            case self::Inprog:
                return "En cours";
            case self::Finished:
                return "Terminée";
            default:
                return "inconnu";
        }
    }
}
