<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IntranetConnection;

class SchoolClass extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'year', 'holder', 'delegate'];

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
        $params = ['alter[include]' => 'students'];
        $classes_array = IntranetConnection::fetchDataFromIntranet($location, $data, $params);
        $classesIntranet = [];
        foreach ($classes_array as $class) {
            $classesIntranet[$class->name] = [
                "name"     => $class->name,
                "year"     => explode(' ', $class->moment->link->name)[1],
                "holder"   => isset($class->master->link->name) ? $class->master->link->name : '',
                "delegate" => isset($class->representative->link->name) ? $class->representative->link->name : '',
            ];
            //save users form the students array
            foreach ($class->students as $student) {

                //check if the user already exists
                foreach (User::all() as $user) {
                    if ($user->email != $student->email) {
                        User::create([
                            'email'      => $student->email,
                            'first_name' => $student->firstname,
                            'last_name'  => $student->lastname,
                            'role_id'    => 3,
                        ]);
                    }
                }
            }
        }

        return $classesIntranet;
    }
    //get the classes from the database
    public static function getClasses()
    {
        $classes = SchoolClass::all();
        $classes_array = [];
        foreach ($classes as $class) {
            $classes_array[$class->name] = [
                "name"     => $class->name,
                "year"     => $class->year,
                "holder"   => $class->holder,
                "delegate" => $class->delegate,
                "status" => $class->status,
            ];
        }
        return $classes_array;
    }

    public static function getAllSortedBy($keyToSortBy = 'id')
    {
        $classesIntranet = SchoolClass::getClasses();
        self::sort_array_of_array($classesIntranet, 'status');
        return $classesIntranet;
    }

    public static function sort_array_of_array(&$array, $subfield)
    {
        $sortarray = array();
        foreach ($array as $key => $row) {
            $sortarray[$key] = $row[$subfield];
        }

        array_multisort($sortarray, SORT_ASC, $array);
    }

    public static function synchronise($class)
    {
        SchoolClass::updateOrCreate([
            'name' => $class['name']
        ],
            [
                'name'     => $class['name'],
                'year'     => $class['year'],
                'holder'   => $class['holder'],
                'delegate' => $class['delegate']
            ]);
    }

    public static function removeOldClasses($classes, $selected)
    {
        foreach ($classes as $class) {
            if (array_key_exists($class['name'], $selected) && $class['status'] == null) {
                SchoolClass::where('name', $class['name'])->delete();
            }
        }
    }

}
