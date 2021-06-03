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
        return redirect()->back()->with('success','Le match à été ajouté.');
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
    public function update(Request $request,$state)
    {
        
        foreach ($request->input("game") as $value) {
          
            try {
                if($state=="inprep"){
                    if($value["editedContender2"] && $value["editedContender1"])
                    {
                        $game = Game::findOrFail($value["game_id"]);
                        if($value["isDeleted"] == 1){
                            $game->delete();
                        }else if(!$value["editedContender2"] || !$value["editedContender1"])
                        {
                            
                        } else {
                            $game->start_time = $value["editedTime"];
                            $game->contender1_id = $value["editedContender1"];
                            $game->contender2_id = $value["editedContender2"];
                            $game->court_id = $value["editedCourt"];
                            $game->save();
                        }
                    }
                }else if ($state=="inprogress"){
                    $game = Game::findOrFail($value["game_id"]);
                    if(isset($value["scorecontender1"]) && empty($value["scorecontender2"]))
                        $value["scorecontender2"]=0;
                    if(isset($value["scorecontender2"]) && empty($value["scorecontender1"]))
                        $value["scorecontender1"]=0;
                    $game->score_contender1 = $value["scorecontender1"];
                    $game->score_contender2 = $value["scorecontender2"];
                    $game->save();
                }

                
            } 
            catch (\Throwable $th) {}
        }
        return redirect()->back()->with('success','Les modifications ont été sauvegardé.');
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
