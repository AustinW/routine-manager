<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('home');

});

Route::get('create-athlete', function() {

	$athlete = new Athlete([
		'usag_id' => '071720',
		'first_name' => 'Austin',
		'last_name' => 'White',
		'gender' => 'male',
		'birthday' => '1988-05-20',
		'trampoline_level' => 'sr',
		'doublemini_level' => 'sr',
		'notes' => '',
		'created_at' => '2013-06-10 15:37:17',
		'updated_at' => '2013-06-10 15:37:17',
	]);

	$athlete = Auth::user()->athletes()->save($athlete);

	dd(Auth::user()->athletes()->get());
});

Route::put('athletes/{athleteId}/{event}/{routineId}', 'AthletesController@putAssociate');

Route::controller('account', 'AccountController');

Route::resource('user', 'UserController');

Route::resource('athletes', 'AthletesController');

Route::resource('routines', 'RoutinesController');

Route::resource('trampoline', 'EventControllers\TrampolineController');

Route::resource('doublemini', 'EventControllers\DoubleMiniController');

Route::resource('tumbling', 'EventControllers\TumblingController');

Route::resource('synchro', 'EventControllers\SynchroController');

Route::resource('skills', 'SkillsController');

Route::get('skills/valid', 'SkillsController@getValid');

Route::any('routines/{id}/skills', 'RoutinesController@showSkills');

Route::post('login', array('as' => 'login', 'uses' => 'AccountController@postLogin'));

// Route::any('bypass', function() {
// 	Auth::logout();
// 	Auth::loginUsingId('5232521cafb0784dac0f3d0a', true);

// 	return ['status' => 'success', 'message' => 'Welcome, ' . Auth::user()->first_name];
// });

Route::get('test/{id}', function($id) {
	dd(Config::get('database.default'), Config::get('database'));
	$athlete = Athlete::find('525b46c94c84a35459000000');
	$routine = $athlete->traPrelimOptional;
	dd($routine);
});

Event::listen('illuminate.query', function($sql, $bindings) {
	Log::info($sql . ' BINDINGS: (' . implode(', ', $bindings) . ')');
});

Route::get('import', function() {
	$skills = Skill::get(['name', 'trampoline_difficulty', 'doublemini_difficulty', 'tumbling_difficulty', 'fig', 'flip_direction', 'occurrence']);

	foreach ($skills as $skill) {
		echo 'db.routine_manager.insert(' . $skill . ');'."<br />";
	}

});

Route::options('{resource?}/{id?}/{var1?}/{var2?}', function() {
    $response = Response::make('ok', 200);
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Access-Control-Allow-Headers', 'X-Requested-With, Authorization');
    return $response;
});