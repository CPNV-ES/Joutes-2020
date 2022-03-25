<?php

use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('homepage');

Route::post('pools/contenders/unlink', 'ContenderController@detachContender');


Route::resource('events', 'EventController')->register();
Route::resource('tournaments', 'TournamentController')->register();
//Route::post('/events/tournaments/copy',  'TournamentController@copy')->name('events.tournaments.copy');
Route::resource('events.tournaments', 'TournamentController')->register();
Route::resource('courts', 'CourtController')->register();
Route::resource('sports', 'SportController')->register();
Route::resource('teams', 'TeamController')->register();
Route::resource('team.user', 'TeamUserController')->register();
Route::delete('users/destroy', 'UserController@destroyAll')->name('users.destroy.all');
Route::resource('users', 'UserController')->register();
Route::resource('tournaments.teams', 'TeamController')->register();
Route::resource('tournaments.pools', 'PoolController')->register();
Route::get('/tournaments/pools/{pool}', 'PoolController@close')->name('tournaments.pools.close');
Route::resource('pools.contenders', 'ContenderController')->register();
Route::resource('games', 'GameController')->register();
Route::resource('events.engagements', EventEngagementController::class)->only([
    'create', 'store'
]);


//Administration resources
Route::resource('administrations', 'Admin\AdministrationController')->register();
Route::resource('roles', 'Admin\RoleController')->register();
Route::resource('courts', 'Admin\CourtController')->register();

//Azure
//Azure
Route::get('/auth/azure', 'Auth\AuthController@redirectToProvider')->name('login');
Route::get('/callback', 'Auth\AuthController@handleProviderCallback');
Route::get('/auth/logout', 'Auth\AuthController@logoutUser')->name('logout');
