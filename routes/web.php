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

Route::get('/', function () {
    return redirect()->route('events.index');
});


Route::resource('events', 'EventController');
Route::resource('tournaments', 'TournamentController');
Route::resource('events.tournaments', 'TournamentController');
Route::resource('courts', 'CourtController');
Route::resource('sports', 'SportController');
Route::resource('tournaments.teams', 'TeamController');
Route::resource('participants', 'ParticipantController');
Route::resource('tournaments.pools', 'PoolController');

//Administration resources
Route::resource('administrations', 'Admin\AdministrationController');
Route::resource('roles', 'Admin\RoleController');

