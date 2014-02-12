<?php

namespace Compcard;

use Austinw\Pdfdf\Pdfdf;
use Routine;
use Athlete;

class TumblingCompcard extends BaseCompcard
{
	protected $compcardType = 'tumbling';

	public function __construct(Pdfdf $pdfdf, Athlete $athlete, CompcardMapper $compcardMapper)
	{
		parent::__construct($pdfdf, $athlete, $compcardMapper);
	}

	protected function mapRoutine(Routine $routine, array $fields, $routineType)
	{
		$this->compcardMapper->massAssign($routine, $routineType);
	}

	protected function mapRoutines(array $fields)
	{
		parent::mapEachRoutine($this->athlete->tumblingPasses, $fields);
	}
}