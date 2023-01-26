<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\Sport;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function index()
    {
        $courts = Court::all();
        return view('administrations.courts.index')->with(compact('courts'));
    }

    public function create(Request $request, Court $court)
    {
        $sports = Sport::all();
        return view('administrations.courts.create')->with(compact('sports'));
    }

    public function edit(Court $court)
    {
        $sports = Sport::all();
        return view('administrations.courts.edit')->with((compact('court', 'sports')));
    }

    public function update(Request $request, Court $court)
    {
        $court->fill($request->all());

        $court->save();

        return redirect()->route('courts.index');
    }

    public function store(Request $request, Court $court)
    {
        $court = new Court();
        $court->fill($request->all());

        $court->save();

        return redirect()->route('courts.index');
    }

    public function destroy(Request $request, Court $court)
    {
        $court->delete();
        return redirect()->route('courts.index');
    }
}
