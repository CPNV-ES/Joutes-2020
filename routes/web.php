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


Route::resource('events', 'EventController', ['only' => ['index', 'show']]);
Route::resource('tournaments', 'TournamentController');
Route::resource('events.tournaments', 'EventTournamentController', [ 'only' => ['index', 'show']]);
Route::resource('courts', 'CourtController');
Route::resource('sports', 'SportController');
Route::resource('teams', 'TeamController');
Route::resource('participants', 'ParticipantController');

//Administration resources
Route::resource('administrations', 'Admin\AdministrationController');
Route::resource('roles', 'Admin\RoleController');

