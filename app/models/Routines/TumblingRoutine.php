<?php

namespace Routines;

use \App;
use \SkillAnalysis;

class TumblingPass extends BaseRoutine implements RoutineRepository {

	public function user()
	{
		$this->belongsTo('User');
	}

	public function athletes()
	{
		$this->belongsToMany('Athlete');
	}

	public function assignSkills(SkillAnalysis $skillAnalysis)
	{
		$this->skills = $skillAnalysis->skills;
	}

	public function totalDifficulty($event = 'tumbling_passes')
	{
		return parent::totalDifficulty($event);
	}
}