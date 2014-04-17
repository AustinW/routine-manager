<?php

class DoubleminiPass extends Routine
{

	const MOUNTER  = 0;
	const SPOTTER  = 1;
	const DISMOUNT = 2;

	protected $table = 'routines';

	protected $appends = ['difficulty'];

	public static $parts = ['mounter', 'spotter', 'dismount'];

	public function scopeDmtPass1($query)  { return $query->where('routine_type', '=', 'dmt_pass1'); }
	public function scopeDmtPass2($query)  { return $query->where('routine_type', '=', 'dmt_pass2'); }
	public function scopeDmtPass3($query)  { return $query->where('routine_type', '=', 'dmt_pass3'); }
	public function scopeDmtPass4($query)  { return $query->where('routine_type', '=', 'dmt_pass4'); }
	
	public function difficulty()
	{
		return $this->eventDifficulty('doublemini');
	}

	public static function position($index)
	{
		$positions = array('mounter', 'spotter', 'dismount');
		return $positions[$index];
	}

	public function getDifficultyAttribute()
	{
		return $this->difficulty();
	}
}