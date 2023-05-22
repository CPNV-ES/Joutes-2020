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
        $location = settings('CLASSES_ORIGIN_NAME');
        $requiredClasses = settings('CLASSES_REQUIRED');
        $data = "classes.json";
        $params = ['alter[include]' => 'students'];
        $classes_array = IntranetConnection::fetchDataFromIntranet($location, $data, $params);
        $classesIntranet = [];



        foreach ($classes_array as $class) {
            //check if the class already exists
            $exists = false;
            //check if the user already exists
            foreach (SchoolClass::all() as $schoolClass) {

                if ($schoolClass->name === $class->name) {
                    $exists = true;
                    $schoolClass_id = $schoolClass->id;
                }
            }
            if (!$exists) {
                $classesIntranet[$class->name] = [
                    "name"     => $class->name,
                    "year"     => explode(' ', $class->moment->link->name)[1],
                    "holder"   => isset($class->master->link->name) ? $class->master->link->name : '',
                    "delegate" => isset($class->representative->link->name) ? $class->representative->link->name : '',
                ];

                //create the class
                $schoolClass_id = SchoolClass::create($classesIntranet[$class->name])->id;
            }else{
                //update the class
                $schoolClassUpdate = SchoolClass::find($schoolClass_id);
                $schoolClassUpdate->year = explode(' ', $class->moment->link->name)[1];
                $schoolClassUpdate->holder = isset($class->master->link->name) ? $class->master->link->name : '';
                $schoolClassUpdate->delegate = isset($class->representative->link->name) ? $class->representative->link->name : '';
                $schoolClassUpdate->updated_at = now();
                $schoolClassUpdate->save();
            }


            //save users form the students array
            foreach ($class->students as $student) {

                $exists = false;
                //check if the user already exists
                foreach (User::all() as $user) {
                    if ($user->email === $student->email) {
                        $exists = true;
                    }
                }
                if (!$exists) {
                    User::create([
                        'email'      => $student->email,
                        'first_name' => $student->firstname,
                        'last_name'  => $student->lastname,
                        'class_name' => "a",
                        'role_id'    => 3,
                        'class_id'   => $schoolClass_id,
                    ]);
                }else{
                    $userUpdate = User::where('email', $student->email)->first();
                    $userUpdate->first_name = $student->firstname;
                    $userUpdate->last_name = $student->lastname;
                    $userUpdate->class_name = "a";
                    $userUpdate->class_id = $schoolClass_id;
                    $userUpdate->updated_at = now();
                }
                //delete the student from the array
                unset($student);
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
                "status"   => $class->status,
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
                'delegate' => $class['delegate'],
                'status'   => now(),
            ]);
    }

    public static function getClassNameById($id)
    {
        $class = SchoolClass::find($id);
        return $class->name;
    }
}
