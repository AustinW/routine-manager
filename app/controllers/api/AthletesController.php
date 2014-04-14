<?php

namespace Api;

// Routine Models
use Routine;

// Models
use User, Athlete;

// Laravel Facades
use Validator, Input, Auth, Response, Lang, Str;

// Laravel Classes
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\QueryException;

// Exceptions
use AthleteException;

class AthletesController extends BaseController
{
	protected $athleteRepository;

	protected $routineRepository;

	public function __construct(Athlete $athleteRepository, Routine $routineRepository)
	{
		parent::__construct();

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
		return $this->athleteRepository->where('user_id', Auth::user()->getKey())->whereNull('deleted_at')->get()->toEmberArray();
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

		return ($athlete) ? $athlete->toEmberArray() : Response::apiError(Lang::get('athlete.not_found'), 404);

	}

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

		$input = Input::json()->get('athlete');

		foreach ($attributes as $key) {
			if (isset($input[$key])) $athlete->$key = $input[$key];
		}

		if ($athlete->isInvalid()) return $athlete->apiErrorResponse();
		
		$athlete->save();

		return $athlete->toEmberArray();

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$athlete = $this->athleteRepository->findCheckOwner($id)->first();
		$athleteName = $athlete->name();

		if ($athlete->delete()) {
			return Response::apiMessage(Lang::get('athlete.deleted', array('name' => $athleteName)));
		} else {
			return Response::apiError(Lang::get('athlete.delete_failed', array('name' => $athleteName)));
		}
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

		if ( ! Routine::correctType($routine->type, $routineType))
			return Response::apiError(Lang::get('routine.incorrect_type', array('routine_type' => $routine->type, 'specified_routine_type' => $routineType)));

		$athlete = Auth::user()->athletes()
			->where($this->athleteRepository->getKeyName(), $athleteId)
			->whereNull('deleted_at')
			->first();

		if ( ! $athlete)
			return Response::apiNotFoundError(Lang::get('athlete.not_found', array('id' => $athleteId)));

		try {
			$athlete->routines()->attach($routine, array('routine_type' => $routineType));
		} catch (QueryException $e) {
			return Response::apiError(Lang::get('routine.already_associated', array(
				'routine_type' => Routine::descriptiveRoutineType($routineType),
				'possessive'   => $athlete->possessive()
			)), 400);
		}
		
		return Response::apiMessage(Lang::get('routine.associated', array(
			'routine_name' => $routine->name,
			'athlete_name' => $athlete->name(),
			'routine_type' => Routine::descriptiveRoutineType($routineType),
			'possessive'   => $athlete->possessive(),
		)));
	}

	public function deleteAssociation($athleteId, $routineType)
	{
		$input = array('routine_type' => $routineType);
		
		$validation = Validator::make($input, array('routine_type' => 'in:' . implode(',', Routine::$whichRoutineFields)));

		if ($validation->fails()) {
			return Response::apiValidationError($validation, $input);
		}

		$athlete = $this->athleteRepository->findCheckOwner($athleteId)->first();

		$routine = $athlete->routines->filter(function($routine) use($routineType) {
			return ($routine->pivot->routine_type == $routineType) ? $routine : null;
		})->get(1);

		$messageParams = array(
			'name'         => $athlete->name(),
			'routine_type' => Routine::descriptiveRoutineType($routineType)
		);
		
		if ($routine && $routine->pivot->delete()) {
			return Response::apiMessage(Lang::get('routine.unassociated', $messageParams));
		} else {
			return Response::apiError(Lang::get('routine.unassociate_failed', $messageParams));
		}
	}

	public function putAssociateSynchroPartner($athleteId, $partnerId)
	{
		$input = array('athlete_id' => $athleteId, 'partner_id' => $partnerId);

		$validation = Validator::make($input, array(
			'athlete_id' => 'required|exists:athletes,id',
			'partner_id' => 'required|exists:athletes,id',
		));

		if ($validation->fails()) {
			return Response::apiValidationError($validation, $input);
		}

		$athlete = $this->athleteRepository->findCheckOwner($athleteId)->first();
		$partner = $this->athleteRepository->findCheckOwner($partnerId)->first();

		try {
			Athlete::checkSynchroPartner($this->user, $athlete, $partner);
		} catch (AthleteException $e) {
			return Response::apiExceptionError($e);
		}

		// Bind the partners together
		$athleteBinding = $athlete->synchroPartner()->save($partner);
		$partnerBinding = $partner->synchroPartner()->save($athlete);

		if ($athleteBinding && $partnerBinding) {
			return Response::apiMessage(Lang::get('athlete.synchro_associated', array(
				'partner1' => $athlete->name(),
				'partner2' => $partner->name(),
			)), array(
				'athlete' => $athlete->toArray(),
				'partner' => $partner->toArray(),
			));
		} else {
			return Response::apiError(Lang::get('athlete.synchro_error', array(
				'partner1' => $athlete->name(),
				'partner2' => $partner->name(),
			)));
		}
	}

	public function deleteAssociatedSynchroPartner($athleteId)
	{
		$input = array('athlete_id' => $athleteId);

		$validation = Validator::make($input, array('athlete_id' => 'required|exists:athletes,id'));

		if ($validation->fails()) {
			return Response::apiValidationError($validation, $input);
		}

		$athlete = $this->athleteRepository->findCheckOwner($athleteId)->first();

		if ( ! $athlete) {
			return Response::apiError(Lang::get('athlete.not_found', $athleteId), 404);
		}

		$partner = $athlete->synchroPartner;

		if ($partner) {
			$athlete->synchro_partner_id = 0;
			$partner->synchro_partner_id = 0;

			$athleteDetach = $athlete->save();
			$partnerDetach = $partner->save();

			$langParams = array(
				'partner1' => $athlete->name(),
				'partner2' => $partner->name(),
			);

			if ($athleteDetach && $partnerDetach) {
				return Response::apiMessage(Lang::get('athlete.synchro_disassociated', $langParams));
			} else {
				return Response::apiError(Lang::get('athlete.synchro_disassociation_failed', $langParams));
			}
		} else {
			return Response::apiError(Lang::get('athlete.not_found', array('id' => $athlete->synchro_partner_id)), 404);
		}
	}

	public function getRoutinesForEvent($athleteId, $eventOrRoutineType)
	{
		$athlete = $this->athleteRepository->findWithRelationAndCheckOwner(array(

			'routines' => function($query) use($eventOrRoutineType) {
				self::filterEventOrRoutineType($query, $eventOrRoutineType);
			},

			'routines.skills' => function($query) { $query->orderBy('order_index', 'asc'); }

		), $athleteId, Auth::user());
		
		if ($athlete && $athlete->routines) {
			return $athlete->routines;
		} else {
			return Response::apiError(Lang::get('athlete.not_found', array('id' => $athleteId)), 404);
		}

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