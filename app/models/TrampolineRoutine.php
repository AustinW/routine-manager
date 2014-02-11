<?php

class TrampolineRoutine extends Routine
{
	protected $table = 'routines';

	// Trampoline scoped queries
	public function scopeTraPrelimCompulsory($query)  { return $query->where('routine_type', '=', 'tra_prelim_compulsory'); }
	public function scopeTraPrelimOptional($query)    { return $query->where('routine_type', '=', 'tra_prelim_optional'); }
	public function scopeTraSemiFinalOptional($query) { return $query->where('routine_type', '=', 'tra_semi_final_optional'); }
	public function scopeTraFinalOptional($query)     { return $query->where('routine_type', '=', 'tra_final_optional'); }

	public function difficulty()
	{
		return $this->eventDifficulty('trampoline');
	}

}