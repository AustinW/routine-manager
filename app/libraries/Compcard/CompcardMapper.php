<?php

namespace Compcard;

use Routine;

class CompcardMapper
{
	protected $mappedFields = array();

	protected $eventFields;

	public function fields()
	{
		return $this->mappedFields;
	}

	public function eventFields($portion = null)
	{
		if ( ! $portion)
			return $this->eventFields;
		else
			return array_get($this->eventFields, $portion);
	}

	public function getField($key)
	{
		return (isset($this->mappedFields[$key])) ? $this->mappedFields[$key] : '';
	}

	public function setField($key, $value)
	{
		$this->mappedFields[$key] = $value;
	}

	public function assignField($key, $value, $index = null)
	{
		$fieldName = array_get($this->eventFields, $key);

		if ($index !== null)
			$this->mappedFields[$fieldName[$index]] = $value;
		else
			$this->mappedFields[$fieldName] = $value;
	}

	public function massAssign(Routine $routine, $routineType) {}

	protected function resetFields()
	{
		foreach ($this->mappedFields as &$mf) $mf = '';
	}

	protected function useEventFields()
	{
		$this->mappedFields = array_merge($this->mappedFields, array_flip(array_flatten($this->eventFields)));
		$this->resetFields();
	}

	public function setName($value)      { $this->mappedFields['NAME']      = $value; }
	public function setTeam($value)      { $this->mappedFields['TEAM']      = $value; }
	public function setGender($value)    { $this->mappedFields['GENDER']    = $value; }
	public function setLevel($value)     { $this->mappedFields['LEVEL']     = $value; }
	public function setAgeGroup($value)  { $this->mappedFields['AGE-GROUP'] = $value; }
}