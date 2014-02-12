<?php

namespace Compcard;

use Austinw\Pdfdf\Pdfdf;
use Routine;
use Athlete;

class TrampolineCompcard extends BaseCompcard
{
	protected $compcardType = 'trampoline';

	public function __construct(Pdfdf $pdfdf, Athlete $athlete, CompcardMapper $compcardMapper)
	{
		parent::__construct($pdfdf, $athlete, $compcardMapper);
	}

	protected function mapRoutine(Routine $routine, array $fields, $routineType)
	{
		$this->compcardMapper->massAssign($routine, $routineType);

		if ($routineType == 'tra_prelim_compulsory') {

			if (strtolower($this->athlete->trampoline_level) == 'sr') {

			} else if (strtolower($this->athlete->trampoline_level) == 'jr') {

			}

		}
	}

	protected function mapRoutines(array $fields)
	{
		parent::mapEachRoutine($this->athlete->trampolineRoutines, $fields);
	}
}