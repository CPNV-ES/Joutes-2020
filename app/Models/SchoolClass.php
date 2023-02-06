<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IntranetConnection;

class SchoolClass extends Model
{
    use HasFactory;


    protected $fillable = ['name','year','holder','delegate'];
    //protected $guarded = [];

    public static function generateSignature($params)
    {
        $queryParams = $params . getenv('API_KEY') . getenv('API_SECRET');
        $signature = md5($queryParams);

        return $signature;
    }
    public static function fetchClassesFromIntranet()
    {
        $location = "sainte-croix";
        $data = "classes.json";
        $classes_array = IntranetConnection::fetchDataFromIntranet($location,$data, "");
        $classesIntranet = [];
        foreach ($classes_array as $class) {

            $classesIntranet[$class->name] = [
                "name" => $class->name,
                "year" => explode(' ',$class->moment->link->name)[1],
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
                $classes_array[$classIntranet['name']]['status'] = 'synchronisé';
            } else {
                $classes_array[$classIntranet['name']] = [
                    "name" => $classIntranet['name'],
                    "year" => $classIntranet['year'],
                    "holder" => $classIntranet['holder'],
                    "delegate" => $classIntranet['delegate'],
                    "status" => 'pas synchronisé',
                ];
            }
        }

        self::sort_array_of_array($classes_array,'status');
        return $classes_array;
    }

    public static function sort_array_of_array(&$array, $subfield)
    {
        $sortarray = array();
        foreach ($array as $key => $row)
        {
            $sortarray[$key] = $row[$subfield];
        }

        array_multisort($sortarray, SORT_ASC, $array);
    }

    public static function synchronise($class)
    {
        SchoolClass::updateOrCreate([
            'name' => $class['name']],
            [
                'name' => $class['name'],
                'year' => $class['year'],
                'holder' => $class['holder'],
                'delegate' => $class['delegate']
            ]);
}

    public static function removeOldClasses($classes,$selected)
    {
        foreach ($classes as $class) {

            if (array_key_exists($class['name'], $selected) && $class['status'] == null) {
                SchoolClass::where('name', $class['name'])->delete();
            }
        }
    }

}
