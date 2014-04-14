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
	if (App::environment() === 'local') {
		return File::get(public_path() . DIRECTORY_SEPARATOR . 'ember-app' . DIRECTORY_SEPARATOR . '.tmp' . DIRECTORY_SEPARATOR . 'index.html');
	}
});

Route::get('test-pdf', function() {

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

	Zipper::make('austin-white-compcards.zip')->folder($athlete->name())->add(array(
		$trc->getPdfFileName(),
		$dmt->getPdfFileName(),
		$tum->getPdfFileName(),
		$syn->getPdfFileName()
	));
});

Route::get('create-athlete', function() {

	$athlete = new Athlete([
		'usag_id' => '476333',
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
	Route::delete('athletes/{athlete}/synchro-partner/{partner}', 'AthletesController@deleteAssociatedSynchroPartner')
		->where(array('athleteId' => '[0-9]+', 'partnerId' => '[0-9]+'));

	Route::resource('athletes', 'AthletesController');

	Route::get('athletes/{athleteId}/{event}', 'AthletesController@getRoutinesForEvent');

	Route::resource('routines', 'RoutinesController');

	Route::get('routines/{routineId}/skills', 'RoutinesController@getSkills');

	Route::get('compcard/download', 'CompcardController@getDownload');
});

/*
|--------------------------------------------------------------------------
| Auth Token Routes
|--------------------------------------------------------------------------
|
| Routes for tappleby/laravel-auth-token
|
*/

Route::get('api/auth', 'Tappleby\AuthToken\AuthTokenController@index');
Route::post('api/auth', 'Tappleby\AuthToken\AuthTokenController@store');
Route::delete('api/auth', 'Tappleby\AuthToken\AuthTokenController@destroy');


Route::post('oauth/access_token', function()
{
    return AuthorizationServer::performAccessTokenFlow();
});

Route::get('/oauth/authorize', array('before' => 'check-authorization-params|auth', function()
{
    // get the data from the check-authorization-params filter
    $params = Session::get('authorize-params');

    // get the user id
    $params['user_id'] = Auth::user()->id;

    // display the authorization form
    return View::make('authorization-form', array('params' => $params));
}));

Route::post('/oauth/authorize', array('before' => 'check-authorization-params|auth|csrf', function()
{
    // get the data from the check-authorization-params filter
    $params = Session::get('authorize-params');

    // get the user id
    $params['user_id'] = Auth::user()->id;

    // check if the user approved or denied the authorization request
    if (Input::get('approve') !== null) {

        $code = AuthorizationServer::newAuthorizeRequest('user', $params['user_id'], $params);

        Session::forget('authorize-params');

        return Redirect::to(AuthorizationServer::makeRedirectWithCode($code, $params));
    }

    if (Input::get('deny') !== null) {

        Session::forget('authorize-params');

        return Redirect::to(AuthorizationServer::makeRedirectWithError($params));
    }
}));

Route::get('phpinfo', function() { phpinfo(); });