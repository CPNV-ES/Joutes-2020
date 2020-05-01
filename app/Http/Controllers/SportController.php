<?php

namespace App\Http\Controllers;

use App\Sport;
use Illuminate\Http\Request;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sports = Sport::all();
        return view('sports.index')->with(compact('sports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sports = Sport::all();
        return view('sports.create')->with(compact('sports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sports = new Sport();

        $sports->name = $request->input('name');
        $sports->description = $request->input('description');
        $sports->min_participant = $request->input('min_teams');
        $sports->max_participant = $request->input('max_teams');

        $sports->save();
        //return view('sports.index')->with(compact('sports'));
        return redirect()->route('sports.index', ['sports' => $sports]);

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
        $sports = Sport::all();

        return view('sports.edit')->with(compact('sport'));
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
        $sports = new Sport();

        $sports->name = $request->input('name');
        $sports->description = $request->input('description');
        $sports->min_participant = $request->input('min_teams');
        $sports->max_participant = $request->input('max_teams');

        $sports->save();

        return redirect()->route('sports.index', ['sports' => $sports]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sports = Sport::find($id);
        $sports->delete();

        return redirect()->route('sports.index', ['sports' => $sports]);
    }
}
