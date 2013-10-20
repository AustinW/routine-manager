<?php

namespace EventControllers;

use \Routines\TumblingPass;

class TumblingController extends RoutineController {

	protected static $whichRoutineFields = [
		'tum_pass_1',
		'tum_pass_2',
		'tum_pass_3',
		'tum_pass_4',
	];

	public function __construct(TumblingPass $tumblingPassRepository, \Athlete $athleteRepository, \Skill $skillRepository)
	{
		parent::__construct($tumblingPassRepository, $athleteRepository, $skillRepository);
	}
}