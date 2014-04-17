<?php

class TumblingPass extends Routine
{

	protected $table = 'routines';

	protected $appends = ['difficulty'];

	public function scopeTumPass1($query)  { return $query->where('routine_type', '=', 'tum_pass1'); }
	public function scopeTumPass2($query)  { return $query->where('routine_type', '=', 'tum_pass2'); }
	public function scopeTumPass3($query)  { return $query->where('routine_type', '=', 'tum_pass3'); }
	public function scopeTumPass4($query)  { return $query->where('routine_type', '=', 'tum_pass4'); }
	
	public function difficulty()
	{
		return $this->eventDifficulty('tumbling');
	}

	public function getDifficultyAttribute()
	{
		return $this->difficulty();
	}
}