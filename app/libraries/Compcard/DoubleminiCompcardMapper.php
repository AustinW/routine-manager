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
			
			$this->eventFields['dmt_pass_' . $i] = array(
				'mounter' => array(
					'fig' => sprintf('MOUNTER-SKILL%s', $index),
					'dd' => sprintf('DD-1%s', $index),
				),
				'spotter' => array(
					'fig' => sprintf('SPOTTER-SKILL%s', $index),
					'dd' => sprintf('DD-1%s', $index),
				),
				'dismount' => array(
					'fig' => sprintf('DISMOUNT-SKILL%s', $index),
					'dd'  => sprintf('DD-2%s', $index),
				),
				'total' => sprintf('DDTOTAL%s', $index)
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

}