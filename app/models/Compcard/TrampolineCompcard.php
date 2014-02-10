<?php

namespace Compcard;

use Austinw\Pdfdf\Pdfdf;
use Routine;
use Athlete;
use Config;
use Str;

class TrampolineCompcard extends BaseCompcard
{
	protected $compcardType = 'trampoline';

	public function __construct(Pdfdf $pdfdf, Athlete $athlete, CompcardMapper $compcardMapper)
	{
		parent::__construct($pdfdf, $athlete, $compcardMapper);
		
		$this->compcardMapper->useTrampoline();

		$this->pdfSource = Config::get('app.compcards.source.tra');
	}

	protected function mapRoutine(Routine $routine, array $fields, $routineType)
	{
		$this->compcardMapper->massTrampolineAssign($routine, $routineType);

		foreach ($fields as $field) {
			$field->setValue($this->compcardMapper->getField($field->getName()));
		}

		if ($routineType == 'tra_prelim_compulsory') {

			if (strtolower($this->athlete->trampoline_level) == 'sr') {

			} else if (strtolower($this->athlete->trampoline_level) == 'jr') {

			}

		}
	}

	protected function mapRoutines(array $fields)
	{
		$routines = $this->athlete->routines;

		// $this->compcardMapper->assignTrampolineField('tra_prelim_compulsory.fig', 2, 'test');

		foreach ($routines as $routine) {
			
			$this->mapRoutine($routine, $fields, $routine->routineType());
		
		}
	}
}