<?php

namespace Compcard;

use Athlete;
use Routine;
use Austinw\Pdfdf\Pdfdf;

use Str;

class BaseCompcard
{
	protected static $ATHLETE_NAME = 'NAME';

	protected static $ATHLETE_TEAM = 'TEAM';

	protected static $ATHLETE_GENDER = 'MF 1';

	protected static $ATHLETE_LEVEL = 'MF 2';

	protected $pdfdf;

	protected $routine;

	protected $athlete;

	protected $pdfSource;

	protected $compcardType;

	protected $compcardMapper;

	public function __construct(Pdfdf $pdfdf, Athlete $athlete, CompcardMapper $compcardMapper)
	{
		$this->pdfdf          = $pdfdf;
		$this->athlete        = $athlete;
		$this->compcardMapper = $compcardMapper;
	}

	protected function mapCompcard(Athlete $athlete, array $fields)
	{
		// Set athlete information
		$this->compcardMapper->setName($athlete->name());
		$this->compcardMapper->setTeam($athlete->team);
		$this->compcardMapper->setGender(ucwords($athlete->gender[0]));
		$this->compcardMapper->setLevel(ucwords($athlete->{$this->compcardType . '_level'}));

		$this->mapRoutines($fields);
	}

	protected function mapRoutines(array $fields) {}

	public function generate()
	{
		// Generate the FDF file
		$fields = $this->pdfdf->extractFields($this->pdfSource);

		// Map the routine, athlete, and skills to fdf fields
		$this->mapCompcard($this->athlete, $fields);

		foreach ($fields as $field) {
			if ($field->getValue() == null) $field->setValue(' ');
		}

		// Merge the fdf content with pdf
		$this->pdfdf->generate($this->pdfSource, Str::slug($this->athlete->name() . ' ' . $this->compcardType), $fields);
	}

	protected function mapRoutine(Routine $routine, array $fields, $routineType) {}
}