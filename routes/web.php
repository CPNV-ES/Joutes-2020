<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\ResultTournamentControllers;

Route::get('/', function () {
    return redirect()->route('events.index');
});


Route::resource('events', 'EventController', ['only' => ['index', 'show']]);
Route::resource('tournaments', 'TournamentController', ['only' => ['index', 'show']]);
Route::resource('events.tournaments', 'EventTournamentController', [ 'only' => ['index', 'show']]);
Route::resource('courts', 'CourtController');

Route::get('tournaments/{id}/results/{pool_id}', 'ResultTournamentControllers@show');
