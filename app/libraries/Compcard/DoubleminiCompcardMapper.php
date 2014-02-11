<?php

namespace Compcard;

use Routine;
use DoubleminiPass;

class DoubleminiCompcardMapper extends CompcardMapper
{
	protected $eventFields = array();

	public function __construct()
	{
		for ($i = 1; $i <= 4; ++$i) {

			$index = ($i == 1) ? '' : '_' . $i;
			$prefix = 'topmostSubform[0].Page1[0].';
			
			$this->eventFields['dmt_pass_' . $i] = array(
				'mounter' => array(
					'fig' => sprintf('%sMounter__1st_Skill%s[0]', $prefix, $index),
					'dd' => sprintf('%sDD__1st_Skill%s[0]', $prefix, $index),
				),
				'spotter' => array(
					'fig' => sprintf('%sSpotter__1st_Skill%s[0]', $prefix, $index),
					'dd' => sprintf('%sDD__1st_Skill%s[0]', $prefix, $index),
				),
				'dismount' => array(
					'fig' => sprintf('%sDismount__2nd_Skill%s[0]', $prefix, $index),
					'dd'  => sprintf('%sDD__2nd_Skill%s[0]', $prefix, $index),
				),
				'total' => sprintf('%sDD__Total_DD%s[0]', $prefix, $index)
			);
		}

		$this->useEventFields();
	}

	public function massAssign(Routine $routine, $routineType)
	{
		$skills = $routine->skills()->orderBy('order_index')->get();

		foreach ($skills as $skillNumber => $skill) {
			$passNumber = substr($routineType, -1);

			$this->assignField($routineType . '.' . DoubleminiPass::position($skill->pivot->order_index) . '.fig', $skill->fig);
			$this->assignField($routineType . '.' . DoubleminiPass::position($skill->pivot->order_index) . '.dd', $skill->doublemini_difficulty);
		}

		$this->assignField($routineType . '.total', $routine->difficulty());
	}

	public function setName($value)      { $this->mappedFields['topmostSubform[0].Page1[0].NAME[0]']      = $value; }
	public function setTeam($value)      { $this->mappedFields['topmostSubform[0].Page1[0].TEAM[0]']      = $value; }
	public function setGender($value)    { $this->mappedFields['topmostSubform[0].Page1[0].MF[0]']        = $value; }
	public function setLevel($value)     { $this->mappedFields['topmostSubform[0].Page1[0].LEVEL[0]']     = $value; }
	public function setAgeGroup($value)  { $this->mappedFields['topmostSubform[0].Page1[0].AGE-GROUP[0]'] = $value; }
}