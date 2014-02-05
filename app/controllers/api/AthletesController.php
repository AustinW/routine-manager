<?php

namespace Api;

// Routine Models
use Routine;

// Models
use \User, \Athlete;

// Laravel Facades
use \Validator, \Input, \Auth, \Response, \Lang, \Str;

// Laravel Classes
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\QueryException;



class AthletesController extends BaseController
{
	protected $athleteRepository;

	protected $routineRepository;

	public function __construct(Athlete $athleteRepository, Routine $routineRepository)
	{
		$this->athleteRepository = $athleteRepository;
		$this->routineRepository = $routineRepository;

		$this->beforeFilter('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->athleteRepository->where('user_id', Auth::user()->getKey())->whereNull('deleted_at')->get();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$newAthlete = $this->athleteRepository;

		$newAthlete->fill(Input::only(array_keys($this->athleteRepository->rules())));

		if ($newAthlete->isInvalid()) {
			return $newAthlete->apiErrorResponse();
		}

		$newAthlete->user_id = Auth::user()->getKey();
		$newAthlete->save();

		if ($newAthlete) {
			return Response::apiMessage(Lang::get('athlete.created'), array('id' => $newAthlete->getKey()), 201);
		} else {
			return Response::apiError(Lang::get('athlete.created_error'), 500);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$athlete = $this->athleteRepository->findCheckOwner($id)->first();

		return ($athlete) ? $athlete : Response::apiError(Lang::get('athlete.not_found'), 404);

	}

	// public function edit($id)
	// {
	// 	$athlete = $this->athleteRepository->findCheckOwner($id)->first();
		
	// 	$synchroPartners = $this->athleteRepository->synchroPartnerArray(
	// 		$this->athleteRepository->excludeAthlete(Auth::user()->athletes()->get(), Auth::user()->getKey())
	// 	);
		
	// 	$trampolineRoutines = $this->trampolineRoutineRepository->routinesForUser(Auth::user()->getKey())->get();
	// 	$doubleMiniPasses = $this->doubleMiniPassRepository->routinesForUser(Auth::user()->getKey())->get();
	// 	$tumblingPasses = $this->tumblingPassRepository->routinesForUser(Auth::user()->getKey())->get();

	// 	return View::make('athletes/edit')->with([
	// 		'athlete'            => $athlete,
	// 		'synchroPartners'    => $synchroPartners,
	// 		'trampolineRoutines' => $this->trampolineRoutineRepository->simpleRoutineArray($trampolineRoutines),
	// 		'doubleMiniPasses'   => $this->doubleMiniPassRepository->simpleRoutineArray($doubleMiniPasses),
	// 		'tumblingPasses'     => $this->tumblingPassRepository->simpleRoutineArray($tumblingPasses),
	// 	]);
	// }

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		$athlete = $this->athleteRepository->findCheckOwner($id)->first();

		if ( ! $athlete) return Response::apiNotFoundError(Lang::get('athlete.not_found', array('id' => $id)));

		$attributes = array_keys($this->athleteRepository->rules());

		foreach ($attributes as $key) {
			if (Input::has($key)) $athlete->$key = Input::get($key);
		}

		if ($athlete->isInvalid()) return $athlete->apiErrorResponse();
		
		$athlete->save();

		return Response::apiMessage(Lang::get('athlete.updated', array('name' => $athlete->name())), $athlete->toArray());

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$athlete = $this->athleteRepository->whereId($id)->whereUserId(Auth::user()->getKey())->first();
		$athleteName = $athlete->name();

		//@todo: Should not need to suppress error here. Bug in L4
		@$athlete->delete();

		return Response::json(['message' => $athleteName . ' deleted.']);
	}

	public function putAssociate($athleteId, $routineType, $routineId)
	{
		$input = array('routine_type' => $routineType);
		
		$validation = Validator::make($input, array('routine_type' => 'in:' . implode(',', Routine::$whichRoutineFields)));

		if ($validation->fails()) {
			return Response::apiValidationError($validation, $input);
		}

		$routine = $this->routineRepository->findCheckOwner($routineId)->first();

		if ( ! $routine)
			return Response::apiNotFoundError(Lang::get('routine.not_found', array('id' => $routineId)));

		$athlete = Auth::user()->athletes()
			->where($this->athleteRepository->getKeyName(), $athleteId)
			->whereNull('deleted_at')
			->first();

		if ( ! $athlete)
			return Response::apiNotFoundError(Lang::get('athlete.not_found', array('id' => $athleteId)));

		try {
			$athlete->routines()->attach($routine, array('routine_type' => $routineType));
		} catch (QueryException $e) {
			return Response::apiError(Lang::get('routine.already_associated', array('routine_type' => Routine::descriptiveRoutineType($routineType))), 400);
		}
		
		return Response::apiMessage(Lang::get('routine.associated', array(
			'routine_name' => $routine->name,
			'athlete_name' => $athlete->name(),
			'routine_type' => Routine::descriptiveRoutineType($routineType),
			'possessive'   => $athlete->possessive(),
		)));
	}

	public function getRoutinesForEvent($athleteId, $eventOrRoutineType)
	{
		$athlete = $this->athleteRepository->findWithRelationAndCheckOwner(array(

			'routines' => function($query) use($eventOrRoutineType) {
				self::filterEventOrRoutineType($query, $eventOrRoutineType);
			},

			'routines.skills' => function($query) { $query->orderBy('order_index', 'asc'); }

		), $athleteId, Auth::user());
		
		return $athlete->routines;

	}

	public static function filterEventOrRoutineType(Relation $query, $eventOrRoutineType)
	{
		$events = array('trampoline' => 'tra', 'synchro' => 'sync', 'doublemini' => 'dmt', 'tumbling' => 'tum');

		$routineTypes = Routine::$whichRoutineFields;

		if (in_array($eventOrRoutineType, array_keys($events))) {
			$query->where('routine_type', 'LIKE', $events[$eventOrRoutineType] . '_%');
		} else if (in_array($eventOrRoutineType, $events)) {
			$query->where('routine_type', 'LIKE', $eventOrRoutineType . '_%');
		} else if (in_array($eventOrRoutineType, $routineTypes)) {
			$query->where('routine_type', '=', $eventOrRoutineType);
		} else {
			throw new \Exception(Lang::get('routine.unrecognized_type', array('routine_type' => $eventOrRoutineType)));
		}
	}

}