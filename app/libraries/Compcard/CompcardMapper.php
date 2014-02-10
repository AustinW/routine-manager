<?php

namespace Compcard;

use Routine;

class CompcardMapper
{
	protected $mappedFields = array(
		'NAME' => '',
		'TEAM' => '',
		'MF 1' => '',
		'MF 2' => '',
	);

	protected $trampolineFields = array(

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

	public function fields()
	{
		return $this->mappedFields;
	}

	public function trampolineFields($portion = null)
	{
		if ( ! $portion)
			return $this->trampolineFields;
		else
			return array_get($this->trampolineFields, $portion);
	}

	public function massTrampolineAssign(Routine $routine, $routineType)
	{
		$skills = $routine->skills()->orderBy('order_index')->get();

		for ($i = 0, $s = count($skills); $i < $s; ++$i) {
			$figFields = $this->trampolineFields($routineType . '.fig');
			$ddFields  = $this->trampolineFields($routineType . '.dd');

			if ($skill = $skills->get($i)) {
				$this->assignTrampolineField($routineType . '.fig', $i, $skill->fig);
				$this->assignTrampolineField($routineType . '.dd', $i, $skill->trampoline_difficulty);
			}
		}

		$this->assignTrampolineField($routineType . '.total', 0, $routine->totalDifficulty('trampoline'));
	}

	public function getField($key)
	{
		return (isset($this->mappedFields[$key])) ? $this->mappedFields[$key] : '';
	}

	public function setField($key, $value)
	{
		$this->mappedFields[$key] = $value;
	}

	public function assignTrampolineField($key, $index, $value)
	{
		$fieldName = array_get($this->trampolineFields, $key);

		$this->mappedFields[$fieldName[$index]] = $value;
	}

	public function useTrampoline()
	{
		$this->mappedFields = array_merge($this->mappedFields, array_flip(array_flatten($this->trampolineFields)));
		$this->resetFields();
	}

	protected function resetFields()
	{
		foreach ($this->mappedFields as &$mf) $mf = '';
	}

	public function setName($value)   { $this->mappedFields['NAME']   = $value; }
	public function setTeam($value)   { $this->mappedFields['TEAM']   = $value; }
	public function setGender($value) { $this->mappedFields['MF 1'] = $value; }
	public function setLevel($value)  { $this->mappedFields['MF 2']  = $value; }
}