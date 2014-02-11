<?php

namespace Compcard;

use Routine;

class TrampolineCompcardMapper extends CompcardMapper
{
	protected $eventFields = array(

		'tra_prelim_compulsory' => array(
			'fig'   => array('SKILLS1', 'SKILLS2', 'SKILLS3', 'SKILLS4', 'SKILLS5', 'SKILLS6', 'SKILLS7', 'SKILLS8', 'SKILLS9', 'SKILLS10'),
			'dd'    => array('DD1', 'DD2', 'DD3', 'DD4', 'DD5', 'DD6', 'DD7', 'DD8', 'DD9', 'DD10'),
			'total' => array('DDTOTAL'),
		),

		'tra_prelim_optional' => array(
			'fig'   => array('SKILLS1_2', 'SKILLS2_2', 'SKILLS3_2', 'SKILLS4_2', 'SKILLS5_2', 'SKILLS6_2', 'SKILLS7_2', 'SKILLS8_2', 'SKILLS9_2', 'SKILLS10_2'),
			'dd'    => array('DD1_2', 'DD2_2', 'DD3_2', 'DD4_2', 'DD5_2', 'DD6_2', 'DD7_2', 'DD8_2', 'DD9_2', 'DD10_2'),
			'total' => array('DDTOTAL_2'),
		),

		'tra_semi_final_optional' => array(
			'fig'   => array(),
			'dd'    => array(),
			'total' => array(),
		),

		'tra_final_optional' => array(
			'fig'   => array('SKILLS1_3', 'SKILLS2_3', 'SKILLS3_3', 'SKILLS4_3', 'SKILLS5_3', 'SKILLS6_3', 'SKILLS7_3', 'SKILLS8_3', 'SKILLS9_3', 'SKILLS10_3'),
			'dd'    => array('DD1_3', 'DD2_3', 'DD3_3', 'DD4_3', 'DD5_3', 'DD6_3', 'DD7_3', 'DD8_3', 'DD9_3', 'DD10_3'),
			'total' => array('DDTOTAL_3'),
		),
	);

	public function __construct()
	{
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
				$this->assignField($routineType . '.dd', $skill->trampoline_difficulty, $i);
			}
		}

		$this->assignField($routineType . '.total', $routine->difficulty(), 0);
	}
}