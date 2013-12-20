<?php

namespace Routines;

use \App;
use \SkillAnalysis;

class DoubleMiniPass extends BaseRoutine implements RoutineRepository
{
	protected $collection = 'doublemini_passes';

	protected $skillRepository;

	protected $guarded = [];

	public $postRules = [
		'name'        => 'required|max:100',
		'description' => 'max:1000',
		'skills'      => 'required|skills',
	];

	public $putRules = [
		'name'        => 'max:100',
		'description' => 'max:1000',
		'skills'      => 'required|array|count:10|skills',
	];

	public static $parts = ['mounter', 'spotter', 'dismount'];

	public static function find($id, $columns = ['*'])
	{
		$result = parent::find($id, $columns);

		if ($result) {
			array_map(function($skill) {
				return App::make('Skill')->fill($skill);
			}, $result->skills);
		}

		return $result;
	}

	public function athleteDmtPass1() { return $this->hasOne('Routines\DoubleMiniPass', 'dmt_pass_1'); }
	public function athleteDmtPass2() { return $this->hasOne('Routines\DoubleMiniPass', 'dmt_pass_2'); }
	public function athleteDmtPass3() { return $this->hasOne('Routines\DoubleMiniPass', 'dmt_pass_3'); }
	public function athleteDmtPass4() { return $this->hasOne('Routines\DoubleMiniPass', 'dmt_pass_4'); }

	public function assignSkills(SkillAnalysis $skillAnalysis)
	{
		$this->skills = $skillAnalysis->skills;
	}

	public function analyzeSkills()
	{
		$skillRepository = App::make('Skill');

		$analysis = new SkillAnalysis();

		// Loop through each skill of the routine
		foreach (self::$parts as $part) {

			if ( ! empty($this->skills[$part])) {

				// Perform a fuzzy search to identify the skill given
				$fuzzySkill = $skillRepository->fuzzyFind($this->skills[$part]);

				// If the skill was identified, convert the model to an array and append
				if ($fuzzySkill) {

					// Need to convert to skill object
					$analysis->skills[$part] = $fuzzySkill->toArray();

				} else {

					$analysis->errors[] = ['index' => $part, 'skill' => $this->$part];

				}
			}
		}

		if ($analysis->problem()) {
			$analysis->message = 'There was an issue analyzing the inputted skills.';
		}

		return $analysis;
	}

	public function totalDifficulty($event = 'doublemini_difficulty')
	{
		return parent::totalDifficulty($event);
	}
}