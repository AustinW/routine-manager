<?php

namespace EventControllers;

use \Auth;
use \Input;
use \Response;
use \Routines\RoutineRepository;

abstract class RoutineController extends \BaseController {

	protected $routineRepository, $athleteRepository, $skillRepository;

	protected static $whichRoutineFields;

	public function __construct(RoutineRepository $routineRepository, \Athlete $athleteRepository, \Skill $skillRepository)
	{
		$this->routineRepository = $routineRepository;
		$this->athleteRepository = $athleteRepository;
		$this->skillRepository   = $skillRepository;

		$this->beforeFilter('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->routineRepository->where('user_id', Auth::user()->_id)->whereNull('deleted_at')->get();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Let the base model know which rule set to apply
		$this->routineRepository->changeValidation('post');

		$routine = $this->routineRepository;

		// Fill the routine model with basic information
		$routine->fill(Input::only('name', 'description', 'skills'));

		// Check validation on the model
		if ($routine->isInvalid()) {
			return $routine->errorResponse();
		}

		$skillAnalysis = $routine->analyzeSkills();

		if ($skillAnalysis->problem()) {
			return Response::json($skillAnalysis->toArray(), 400);
		}

		$routine->assignSkills($skillAnalysis);

		if (Input::has('athlete_id')) {
			
			$athlete = Auth::user()->athletes()->find(Input::get('athlete_id'))->whereNull('deleted_at')->first();

		}

		Auth::user()->trampolineRoutines()->save($routine);

		if ($routine) {
			return Response::json(['message' => 'Routine created.', 'id' => $routine->_id], 201);
		} else {
			return Response::json(['message' => 'Problem creating routine.'], 500);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$routine = $this->routineRepository->find($id);

		return ($routine) ? $routine : Response::json(['message' => 'Specified routine (' . $id . ') could not be found.'], 404);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$routine = $this->routineRepository;

		$routine = $this->routineRepository->find($id)->where('user_id', Auth::user()->_id)->first();

		$metaFields = Input::only('name', 'description', 'skills');

		foreach ($metaFields as $metaField => $value) {
			if ($value != null) $routine->$metaField = $value;
		}

		if ($routine->isInvalid()) {
			return $routine->errorResponse();
		}

		Auth::user()->trampolineRoutines()->save($routine);

		if ($routine) {
			return Response::json(['message' => 'Routine created.', 'id' => $routine->_id], 201);
		} else {
			return Response::json(['message' => 'Problem creating athlete'], 500);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}