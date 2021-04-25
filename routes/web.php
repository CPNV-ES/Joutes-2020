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

Route::post('pools/contenders/unlink','ContenderController@detachContender');


Route::resource('events', 'EventController');
Route::resource('tournaments', 'TournamentController');
Route::post('/events/{event}/tournaments/copy',  'TournamentController@copy')->name('events.tournaments.copy');
Route::resource('events.tournaments', 'TournamentController');
Route::resource('courts', 'CourtController');
Route::resource('sports', 'SportController');
Route::resource('teams', 'TeamController');
Route::resource('tournaments.teams', 'TeamController');
//Route::resource('participants', 'ParticipantController');
Route::resource('tournaments.pools', 'PoolController');
// Route::resource('contenders', 'ContenderController');
Route::resource('pools.contenders', 'ContenderController');
Route::resource('games', 'GameController');

//Administration resources
Route::resource('administrations', 'Admin\AdministrationController');
Route::resource('roles', 'Admin\RoleController');
Route::resource('courts', 'Admin\CourtController');

//Azure
//Azure
Route::get('/auth/azure', 'Auth\AuthController@redirectToProvider')->name('login');
Route::get('/callback', 'Auth\AuthController@handleProviderCallback')->name('logout');
Route::post('/auth/logout', 'Auth\AuthController@logoutUser');
