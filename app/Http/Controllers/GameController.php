<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $games = Game::all();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $game = new Game();
        $game->date = $request->input('date');
        $game->start_time = $request->input('start_time');
        $game->contender1_id = $request->input('firstContender');
        $game->contender2_id = $request->input('secondContender');
        $game->court_id = $request->input('location');
        $game->save();
        return redirect()->back();
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$game_id)
    {
        foreach ($request->input("game") as $value) {
            $game = Game::findOrFail($value["game_id"]);
            $game->start_time = $value["editedTime"];
            $game->contender1_id = $value["editedContender1"];
            $game->contender2_id = $value["editedContender2"];
            $game->court_id = $value["editedCourt"];
            $game->save();
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($game)
    {
        $game = Game::findOrFail($game);
        $game->delete();

        return redirect()->back();

    }
}
