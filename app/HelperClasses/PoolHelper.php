<?php


namespace App\HelperClasses;


class PoolHelper
{
    public static function poolState($pool)
    {
        switch ($pool->poolState){
            case 0:
                return "En Préparation";
            case 1:
                return "Prête à débuter";
            case 2:
                return "En cours";
            case 3:
                return "Terminée";
            default:
                return "inconnu";
        }
    }

    public static function isFull($pool)
    {
        $nbContenders = 0;
        foreach ($pool->contenders as $contender){
            if($contender->pool_id === $pool->id) ++$nbContenders;
        }
        if($pool->poolSize === $nbContenders){
            return true;
        }
        return false;
    }
}
