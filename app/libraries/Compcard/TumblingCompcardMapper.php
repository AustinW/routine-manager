<?php

namespace Compcard;

use Routine;
use TumblingPass;

class TumblingCompcardMapper extends CompcardMapper
{
	protected $eventFields = array();

	public function __construct()
	{

		$figFields = array('SKILLS1', 'SKILLS2', 'SKILLS3', 'SKILLS4', 'SKILLS5', 'SKILLS6', 'SKILLS7', 'SKILLS8');
		$ddFields = array('DD1', 'DD2', 'DD3', 'DD4', 'DD5', 'DD6', 'DD7', 'DD8');

		for ($i = 1; $i <= 4; ++$i) {

			$index = ($i == 1) ? '' : '_' . $i;
			
			$this->eventFields['tum_pass_' . $i] = array(
				'fig' => array_map(
					function($field) use ($index) { return $field . $index; },
					$figFields
				),
				'dd' => array_map(
					function ($field) use ($index) { return $field . $index; },
					$ddFields
				),
				'total' => 'DDTOTAL' . $index
			);
		}

		$this->useEventFields();
	}

	public function massAssign(Routine $routine, $routineType)
	{
		$skills = $routine->skills()->orderBy('order_index')->get();

		for ($i = 0, $s = count($skills); $i < $s; ++$i) {
			$figFields = $this->eventFields($routineType . '.fig');
			$ddFields  = $this->eventFields($routineType . '.dd');

			if ($skill = $skills->get($i)) {
				$this->assignField($routineType . '.fig', $skill->fig, $i);
				$this->assignField($routineType . '.dd', $skill->tumbling_difficulty, $i);
			}
		}

		$this->assignField($routineType . '.total', $routine->difficulty());
	}
}