<?php

namespace Compcard;

use Austinw\Pdfdf\Pdfdf;
use Routine;
use Athlete;
use Config;

class TumblingCompcard extends BaseCompcard
{
	protected $compcardType = 'tumbling';

	// Override the header fields (different than trampoline compcard)
	protected $mappedFields = array(
		'topmostSubform[0].Page1[0].NAME[0]'      => '',
		'topmostSubform[0].Page1[0].TEAM[0]'      => '',
		'topmostSubform[0].Page1[0].AGE-GROUP[0]' => '',
		'topmostSubform[0].Page1[0].LEVEL[0]'     => '',
		'topmostSubform[0].Page1[0].MF[0]'        => '',
	);

	public function __construct(Pdfdf $pdfdf, Athlete $athlete, CompcardMapper $compcardMapper)
	{
		parent::__construct($pdfdf, $athlete, $compcardMapper);
		
		$this->pdfSource = Config::get('app.compcards.source.tum');
	}



	protected function mapRoutine(Routine $routine, array $fields, $routineType)
	{
		$this->compcardMapper->massAssign($routine, $routineType);

		foreach ($fields as $field) {
			$field->setValue($this->compcardMapper->getField($field->getName()));
		}
	}

	protected function mapRoutines(array $fields)
	{
		$routines = $this->athlete->tumblingPasses;

		foreach ($routines as $routine) {
			
			$this->mapRoutine($routine, $fields, $routine->routineType());
		
		}
	}
}