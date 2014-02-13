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

Route::get('test-pdf', function() {

	// Pdfdf::fill(
	// 	storage_path() . DIRECTORY_SEPARATOR . 'compcards' . DIRECTORY_SEPARATOR . 'comp_elite_tr.pdf',
	// 	storage_path() . DIRECTORY_SEPARATOR . 'compcards' . DIRECTORY_SEPARATOR . 'tr.pdf'
	// );

	$pdfdf = App::make('pdfdf');
	$athlete = Athlete::with('synchroPartner')->find(1);
	$trc = new Compcard\TrampolineCompcard($pdfdf, $athlete, new Compcard\TrampolineCompcardMapper);
	$trc->generate();

	$dmt = new Compcard\DoubleminiCompcard($pdfdf, $athlete, new Compcard\DoubleminiCompcardMapper);
	$dmt->generate();

	$tum = new Compcard\TumblingCompcard($pdfdf, $athlete, new Compcard\TumblingCompcardMapper);
	$tum->generate();

	$syn = new Compcard\SynchroCompcard($pdfdf, $athlete, new Compcard\SynchroCompcardMapper);
	$syn->generate();

});

Route::get('create-athlete', function() {

	$athlete = new Athlete([
		'usag_id' => '071720',
		'first_name' => 'Dalainey',
		'last_name' => 'Glowacki',
		'gender' => 'female',
		'birthday' => '1993-12-15',
		'tumbling_level' => '9',
		'notes' => '',
		'created_at' => '2013-12-26 15:37:17',
		'updated_at' => '2013-12-26 15:37:17',
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

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Routing prefixed for API
|
| NOTE: ALL CONTROLLERS HERE ARE UNDER 'Api' NAMESPACE SO NO COLLISIONS
|
*/

Route::group(array('prefix' => 'api', 'namespace' => 'Api'), function() {
	
	Route::controller('account', 'AccountController');

	Route::put('athletes/{athleteId}/{routineType}/{routineId}', 'AthletesController@putAssociate')
		->where(array('athleteId' => '[0-9]+', 'routineType' => '[a-z_]+', 'routineId' => '[0-9]+'));
	Route::delete('athletes/{athleteId}/{routineType}', 'AthletesController@deleteAssociation')
		->where(array('athleteId' => '[0-9]+', 'routineType' => '[a-z_]+'));

	Route::put('athletes/{athlete}/synchro-partner/{partner}', 'AthletesController@putAssociateSynchroPartner')
		->where(array('athleteId' => '[0-9]+', 'partnerId' => '[0-9]+'));

	Route::resource('athletes', 'AthletesController');

	Route::get('athletes/{athleteId}/{event}', 'AthletesController@getRoutinesForEvent');

	Route::resource('routines', 'RoutinesController');

	Route::get('routines/{routineId}/skills', 'RoutinesController@getSkills');
});

// Route::any('bypass', function() {
// 	Auth::logout();
// 	Auth::loginUsingId('5232521cafb0784dac0f3d0a', true);

// 	return ['status' => 'success', 'message' => 'Welcome, ' . Auth::user()->first_name];
// });
Route::get('attach', function() {
	$austin = Athlete::find('525b46c94c84a35459000000');
	$dalainey = Athlete::find('52bca9694c84a3de02000000');

	$routine = Routines\TrampolineRoutine::find('526596a84c84a3f505000000');

	$austin->traPrelimCompulsory()->associate($routine);


});

Route::get('test/{id}', function($id) {
	echo nl2br(print_r(Config::get('database.default'), true));
	echo nl2br(print_r(Config::get('database'), true));
	die();
	dd(Config::get('database.default'), Config::get('database'));
	$athlete = Athlete::find('525b46c94c84a35459000000');
	$routine = $athlete->traPrelimOptional;
	dd($routine);
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

Route::get('phpinfo', function() {
	phpinfo();
});