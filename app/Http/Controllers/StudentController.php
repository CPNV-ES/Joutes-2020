<?php

namespace App\Http\Controllers;

use App\Sport;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = "https://intranet.cpnv.ch/sainte-croix/etudiants.json?alter[include]=current_class&alter[only]=firstname,lastname";
        $students = json_decode(file_get_contents($request));

        return view('students.index')->with(compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sports = Sport::all();
        return view('students.create')->with(compact('sports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = "https://intranet.cpnv.ch/sainte-croix/etudiants.json?alter[include]=current_class&alter[only]=firstname,lastname";

        $response = Http::get($request);

        $students = new Student();

        $students->lastname = $request->input('lastname');
        $students->firstname = $request->input('firstname');

        $students->save();
        //return view('sports.index')->with(compact('sports'));
        return redirect()->route('students.index', ['students' => $students]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }
}
