<?php

namespace Routines;

class TrampolineRoutine extends BaseRoutine implements RoutineRepository
{
	protected $collection = 'trampoline_routines';

	protected $guarded = [];

	public $postRules = [
		'name'        => 'required|max:100',
		'description' => 'max:1000',
		'skills'      => 'required|array|count:10|skills',
	];

	public $putRules = [
		'name'        => 'max:100',
		'description' => 'max:1000',
		'skills'      => 'required|array|count:10|skills',
	];

	public function user()
	{
		$this->belongsTo('User');
	}

	public function athletes()
	{
		$this->belongsToMany('Athlete');
	}

	public function athleteTraPrelimCompulsory()  { return $this->hasOne('Routines\TrampolineRoutine', 'tra_prelim_compulsory'); }
	public function athleteTraPrelimOptional()    { return $this->hasOne('Routines\TrampolineRoutine', 'tra_prelim_optional'); }
	public function athleteTraSemiFinalOptional() { return $this->hasOne('Routines\TrampolineRoutine', 'tra_semi_final_optional'); }
	public function athleteTraFinalOptional()     { return $this->hasOne('Routines\TrampolineRoutine', 'tra_final_optional'); }

	public function assignSkills(\SkillAnalysis $skillAnalysis)
	{
		$this->skills = $skillAnalysis->skills;
	}

	public function totalDifficulty($event = 'trampoline_difficulty')
	{
		return parent::totalDifficulty($event);
	}
}