<?php

use App\Http\Controllers\Admin\AdministrationController;
use App\Http\Controllers\Admin\CourtController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\ContenderController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRoleUserController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameManagerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PoolController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamUserController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;


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

Route::post('pools/contenders/unlink', [ContenderController::class,'detachContender']);


Route::resource('events', EventController::class)->register();
Route::resource('tournaments', TournamentController::class)->register();
//Route::post('/events/tournaments/copy',  'TournamentController@copy')->name('events.tournaments.copy');
Route::resource('events.tournaments', TournamentController::class)->register();
Route::resource('teams', TeamController::class)->register();
Route::resource('team.user', TeamUserController::class)->register();
Route::delete('users/destroy', [UserController::class,'destroyAll'])->name('users.destroy.all');
Route::resource('users', UserController::class);
Route::resource('tournaments.teams', TeamController::class);
Route::resource('tournaments.pools', PoolController::class);
Route::get('/tournaments/pools/{pool}', [PoolController::class,'close'])->name('tournaments.pools.close');
Route::resource('pools.contenders', ContenderController::class);
Route::resource('pools.gameManagers', GameManagerController::class)->only([
    'store'
]);
Route::resource('games', GameController::class);
Route::resource('events.eventRoleUsers', EventRoleUserController::class)->only([
    'create', 'store', 'update'
]);

Route::resource('events.schedules', ScheduleController::class)->only(['index']);


Route::resource('students', StudentController::class);
Route::resource('carousel', CarouselController::class);

//Administration resources
Route::group(['middleware' => ['admin']], function () {
    Route::delete('users/destroy', [UserController::class,'destroyAll'])->name('users.destroy.all');
    Route::resource('users', UserController::class);
    Route::resource('administrations', AdministrationController::class);
    Route::resource('courts', CourtController::class);
    Route::resource('sports', SportController::class);
    Route::resource('classes', SchoolClassController::class);
});



//Azure
Route::get('/auth/azure', [AuthController::class,'redirectToProvider'])->name('login');
Route::get('/callback', [AuthController::class,'handleProviderCallback']);
Route::get('/auth/logout', [AuthController::class,'logoutUser'])->name('logout');


//Settings
Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
Route::get('/settings/create', [SettingsController::class, 'create'])->name('settings.create');
Route::post('/settings/create', [SettingsController::class, 'store'])->name('settings.store');
Route::post('/settings', [SettingsController::class, 'update '])->name('settings.update');
Route::post('/settings/{setting}', [SettingsController::class, 'destroy'])->name('settings.delete');
