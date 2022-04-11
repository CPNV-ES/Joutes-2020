<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = ['class', 'status'];

    public static function fetchClassFromIntranet()
    {
        $url = "https://intranet.cpnv.ch/sainte-croix/classes.json?api_key=demo&signature=deb6ccd76335e4c3e6a450d6c8db159d";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);

        $classes_array = json_decode($resp);
        $classesIntranet = [];
        foreach ($classes_array as $class) {
            $classesIntranet[$class->name] = [
                "name" => $class->name,
                "year" => $class->moment->link->name,
                "holder" => isset($class->master->link->name) ? $class->master->link->name : '',
                "delegate" => isset($class->representative->link->name) ? $class->representative->link->name : '',
            ];
        }
        return $classesIntranet;
    }
    public static function identifyClass($classesIntranet){
        $classes = SchoolClass::all();
        $classes_array = [];
        foreach ($classes as $class) {
            $classes_array[$class->name] = [
                "name" => $class->name,
                "year" => $class->year,
                "holder" => $class->holder,
                "delegate" => $class->delegate,
                "status" => $class->status,
            ];
        }
        foreach ($classesIntranet as $classIntranet) {
            if (array_key_exists($classIntranet['name'], $classes_array)) {
                $classes_array[$classIntranet['name']]['status'] = 'synchronized';
            } else {
                $classes_array[$classIntranet['name']] = [
                    "name" => $classIntranet['name'],
                    "year" => $classIntranet['year'],
                    "holder" => $classIntranet['holder'],
                    "delegate" => $classIntranet['delegate'],
                    "status" => 'not_synchronized',
                ];
            }
        }
        return $classes_array;
    }

}
