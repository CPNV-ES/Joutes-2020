<?php

namespace App\Http\Controllers;

use App\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classesIntranet = SchoolClass::fetchClassesFromIntranet();
        $classes = SchoolClass::identifyClass($classesIntranet);
        return view('classes.index', compact('classes', 'classesIntranet'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $classesIntranet = SchoolClass::fetchClassesFromIntranet();
        $classes = SchoolClass::identifyClass($classesIntranet);
        $selected = $_POST;
        foreach ($classesIntranet as $class) {
            if (array_key_exists($class['name'], $selected)) {
                SchoolClass::removeOldClasses($classes,$selected);
                SchoolClass::synchronise($class);
            }
        }
        /*$old = SchoolClass::where('name',$class['name']);
        $old->delete();*/
        return redirect()->route('classes.index', compact('classes', 'classesIntranet'));

    }

    /**
     * Display the specified resource.
     *
     * @param \App\SchoolClass $schoolClass
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolClass $schoolClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\SchoolClass $schoolClass
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolClass $schoolClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\SchoolClass $schoolClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $schoolClasses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\SchoolClass $schoolClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolClass $schoolClass)
    {
        //
    }
}
