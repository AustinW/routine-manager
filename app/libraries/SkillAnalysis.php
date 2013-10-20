<?php

class SkillAnalysis {
	public $message;
	public $errors;

	public $skills = [];

	public function toArray()
	{
		return get_object_vars($this);
	}

	public function problem()
	{
		return count($this->errors) > 0;
	}
}