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

	public function assignSkills(\SkillAnalysis $skillAnalysis)
	{
		$this->skills = $skillAnalysis->skills;
	}
}