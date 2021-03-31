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
    public function update(Request $request, $game_id)
    {
        // $game = Game::findOrFail($game_id);
        // $game->contender1_id = $request->input('firstContenderEdited');
        // $game->contender2_id = $request->input('secondContenderEdited');
        // $game->court_id = $request->input('location');
        @dd($request);
      
        

        
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
