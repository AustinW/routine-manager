<?php

namespace Routines;

use \SkillAnalysis;

class DoubleMiniPass extends BaseRoutine implements RoutineRepository
{
	protected $collection = 'doublemini_passes';

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

	public function assignSkills(SkillAnalysis $skillAnalysis)
	{
		$this->skills = $skillAnalysis->skills;
	}

	public function analyzeSkills()
	{
		$skillRepository = App::make('Skill');

		$analysis = new SkillAnalysis();

		// Loop through each skill of the routine
		foreach ($this->skills as $index => $skill) {

			// Perform a fuzzy search to identify the skill given
			$fuzzySkill = $skillRepository->fuzzyFind($skill);

			// If the skill was identified, convert the model to an array and append
			if ($fuzzySkill) {

				// Need to convert to 
				$analysis->skills[] = $fuzzySkill->toArray();

			} else {

				$analysis->errors[] = ['index' => $index, 'skill' => $skill];

			}
		}

		if ($analysis->problem()) {
			$analysis->message = 'There was an issue analyzing the inputted skills.';
		}

		return $analysis;
	}
}