<?php

Validator::resolver(function($translator, $data, $rules, $messages)
{
	return new CustomValidator($translator, $data, $rules, $messages);
});

class CustomValidator extends Illuminate\Validation\Validator {

	public function validateCount($attribute, $value, $parameters)
	{
		return count($value) == (int) $parameters[0];
	}

	public function validateSkills($attribute, $value, $parameters)
	{
		$skillModel = App::make('Skill');

		foreach ($value as $skill) {
			if ( ! $skillModel->validSkill($skill)) {
				return false;
			}
		}

		return true;
	}

	public function validateSkill($attribute, $value, $parameters)
	{
		return (App::make('Skill')->validSkill($value));
	}

	protected function replaceCount($message, $attribute, $rule, $parameters)
	{
		return str_replace(':count', $parameters[0], $message);
	}

}