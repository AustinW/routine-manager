<?php

namespace EventControllers;

use \Routines\DoubleMiniPass;

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
}