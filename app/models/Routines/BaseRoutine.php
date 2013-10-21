<?php

namespace Routines;

use \App;
use \SkillAnalysis;

class BaseRoutine extends \BaseModel
{
    public static $whichRoutineFields = [
        'tra_prelim_compulsory',
        'tra_prelim_optional',
        'tra_semi_final_optional',
        'tra_final_optional',

        'dmt_pass1',
        'dmt_pass2',
        'dmt_pass3',
        'dmt_pass4',

        'tum_pass1',
        'tum_pass2',
        'tum_pass3',
        'tum_pass4',

        'syn_prelim_compulsory',
        'syn_prelim_optional',
        'syn_semi_final_optional',
        'syn_final_optional',
    ];

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

                // Need to convert to skill object
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

    public function totalDifficulty($event)
    {
        $total = 0.0;

        foreach ($this->skills as $skill) {
            $skill = (array) $skill;
            $total += $skill[$event];
        }
        
        return $total;
    }
}