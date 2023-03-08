<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        $classes = SchoolClass::all();

        return view('classes.index', compact('classes'));

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
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $classesIntranet = SchoolClass::getClasses();
        $classes = SchoolClass::fetchClassesFromIntranet();
        $selected = $_POST;
        foreach ($classesIntranet as $class) {
            if (array_key_exists($class['name'], $selected)) {
                SchoolClass::removeOldClasses($classes,$selected);
                SchoolClass::synchronise($class);
            }
        }
        /*$old = SchoolClass::where('name',$class['name']);
        $old->delete();*/
        return redirect()->route('classes.index');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\SchoolClass $schoolClass
     *
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolClass $schoolClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\SchoolClass $schoolClass
     *
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
     * @param \App\Models\SchoolClass  $schoolClass
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $schoolClasses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SchoolClass $schoolClass
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolClass $schoolClass)
    {
        //
    }
}
