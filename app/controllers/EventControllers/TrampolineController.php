<?php

namespace EventControllers;

use \Routines\TrampolineRoutine;

class TrampolineController extends RoutineController {

	protected static $whichRoutineFields = [
		'tra_prelim_compulsory',
		'tra_prelim_optional',
		'tra_semi_final_optional',
		'tra_final_optional',
	];

	public function __construct(TrampolineRoutine $trampolineRoutineRepository, \Athlete $athleteRepository, \Skill $skillRepository)
	{
		parent::__construct($trampolineRoutineRepository, $athleteRepository, $skillRepository);
	}
}