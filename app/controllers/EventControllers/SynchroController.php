<?php

namespace EventControllers;

use \Routines\TrampolineRoutine;

class SynchroController extends RoutineController {

	protected static $whichRoutineFields = [
		'syn_prelim_compulsory',
		'syn_prelim_optional',
		'syn_semi_final_optional',
		'syn_final_optional',
	];

	public function __construct(TrampolineRoutine $trampolineRoutineRepository, \Athlete $athleteRepository, \Skill $skillRepository)
	{
		parent::__construct($trampolineRoutineRepository, $athleteRepository, $skillRepository);
	}
}