<?php

namespace Routines;

use \App;
use \SkillAnalysis;

class TumblingPass extends BaseRoutine implements RoutineRepository {

	public function athleteTumblingPass1() { return $this->hasOne('Routines\TumblingPass', 'tum_pass_1'); }
	public function athleteTumblingPass2() { return $this->hasOne('Routines\TumblingPass', 'tum_pass_2'); }
	public function athleteTumblingPass3() { return $this->hasOne('Routines\TumblingPass', 'tum_pass_3'); }
	public function athleteTumblingPass4() { return $this->hasOne('Routines\TumblingPass', 'tum_pass_4'); }

	public function assignSkills(SkillAnalysis $skillAnalysis)
	{
		$this->skills = $skillAnalysis->skills;
	}

	public function totalDifficulty($event = 'tumbling_passes')
	{
		return parent::totalDifficulty($event);
	}
}