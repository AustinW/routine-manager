<?php

namespace Routines\TrampolineRoutine;

use \Routines\TrampolineRoutine;

class PrelimCompulsory extends TrampolineRoutine
{
	public function athlete()
	{
		return $this->belongsToMany('\Athlete');
	}
}