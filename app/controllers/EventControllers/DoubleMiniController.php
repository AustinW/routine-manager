<?php

namespace EventControllers;

use \Routines\DoubleMiniPass;
use \Input;
use \Auth;
use \Response;

class DoubleMiniController extends RoutineController {

	protected static $whichRoutineFields = [
		'dmt_pass_1',
		'dmt_pass_2',
		'dmt_pass_3',
		'dmt_pass_4',
	];

	public function __construct(DoubleMiniPass $doubleMiniPassRepository, \Athlete $athleteRepository, \Skill $skillRepository)
	{
		parent::__construct($doubleMiniPassRepository, $athleteRepository, $skillRepository);
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
		$routine->fill(Input::only('name', 'description'));

		$skillsTemp = [];
		foreach (DoubleMiniPass::$parts as $part) {
			if (Input::has($part)) $skillsTemp[$part] = Input::get($part);
		}

		$routine->skills = $skillsTemp;

		// Check validation on the model
		if ($routine->isInvalid()) {
			return $routine->errorResponse();
		}

		$skillAnalysis = $routine->analyzeSkills();

		if ($skillAnalysis->problem()) {
			return Response::json($skillAnalysis->toArray(), 400);
		}

		$routine->assignSkills($skillAnalysis);

		Auth::user()->doubleMiniRoutines()->save($routine);

		if ($routine) {
			return Response::json(['message' => 'Double-mini pass created.', 'id' => $routine->_id], 201);
		} else {
			return Response::json(['message' => 'Problem creating double-mini pass.'], 500);
		}
	}
}