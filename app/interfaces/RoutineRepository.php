<?php

namespace Routines;

interface RoutineRepository
{
	public function user();

	public function athletes();

	public function assignSkills(\SkillAnalysis $skillAnalysis);

	public function totalDifficulty();
}