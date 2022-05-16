<?php

namespace App\Http\Controllers;

use App\Event;
use App\Sport;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($eventId)
    {
        $event = Event::find($eventId);
        $registedStudents = $event->users->pluck('first_name', 'last_name')->toArray();
        $expectedStudents = $event->getExpectedParticipants();
        $studentsList = [];
        // get array of registered students firstname and lastname
        foreach ($expectedStudents as $student) {
            //$registedStudents->contains($student['lastname'] && $student['firstname'])
            if (array_key_exists($student['lastname'], $registedStudents) && $registedStudents[$student['lastname']] == $student['firstname']) {
                $studentsList[] = new Student($student['lastname'], $student['firstname'], $student['class'], "Inscrit");
            } else {
                $studentsList[] = new Student($student['lastname'], $student['firstname'], $student['class'], "Pas inscrit");;
            }
        }
        //sort students list by lastname asc
        array_multisort(array_column($studentsList, 'lastname'), SORT_ASC, $studentsList);

        return view('students.show')->with(compact('studentsList'));
    }
}
