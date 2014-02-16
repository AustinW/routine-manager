<?php

namespace Compcard;

use Athlete;
use Routine;
use Austinw\Pdfdf\Pdfdf;

use Str;
use Config;
use Lang;
use Exception;

use Illuminate\Database\Eloquent\Collection;

class BaseCompcard
{
	protected $pdfdf;

	protected $routine;

	protected $athlete;

	protected $pdfSource, $pdfName, $pdfFileName;

	protected $compcardType;

	protected $compcardMapper;

	public function __construct(Pdfdf $pdfdf, Athlete $athlete, CompcardMapper $compcardMapper)
	{
		$this->pdfdf          = $pdfdf;
		$this->athlete        = $athlete;
		$this->compcardMapper = $compcardMapper;

		$this->pdfSource = $this->sourceCompcard($this->compcardType);
	}

	public function setPdfFileName($value) { $this->pdfFileName = $value; }

	public function getPdfFileName() { return $this->pdfFileName; }

	protected function mapCompcard(array $fields)
	{
		// Set athlete information
		$this->compcardMapper->setName($this->athlete->name());
		$this->compcardMapper->setTeam($this->athlete->team);
		$this->compcardMapper->setGender(ucwords($this->athlete->gender[0]));
		$this->compcardMapper->setLevel(ucwords($this->athlete->{$this->compcardType . '_level'}));

		$level = $this->athlete->{$this->compcardType . '_level'};
		$this->compcardMapper->setAgeGroup(Athlete::ageGroup(date('Y'), $level, $this->athlete->birthday));

		$this->mapRoutines($fields);

		foreach ($fields as $field) {
			$field->setValue($this->compcardMapper->getField($field->getName()));
		}
	}

	protected function mapRoutines(array $fields) {}
	
	protected function mapEachRoutine($routines = null, array $fields)
	{
		if ((is_array($routines) && count($routines) > 0) || ($routines instanceof Collection && $routines->count() > 0)) {

			foreach ($routines as $routine) {
				
				$this->mapRoutine($routine, $fields, $routine->routineType());
			
			}

		}
	}

	public function generate()
	{
		// Generate the FDF file
		$fields = $this->pdfdf->extractFields($this->pdfSource);

		// Map the routine, athlete, and skills to fdf fields
		$this->mapCompcard($fields);

		foreach ($fields as $field) {
			if ($field->getValue() == null) $field->setValue(' ');
		}

		// Merge the fdf content with pdf
		$this->pdfdf->generate($this->pdfSource, Str::slug($this->athlete->name() . ' ' . $this->compcardType), $fields);

		$this->setPdfFileName($this->pdfdf->getFileName());
	}

	protected function mapRoutine(Routine $routine, array $fields, $routineType) {}

	protected function sourceCompcard($event)
	{
		$level = $this->athlete->{$event . '_level'};

		if ($level == null) {
			throw new Exception(Lang::get('athlete.invalid_level', array('name' => $this->athlete->name(), 'event' => $event)));
		}

		$compcardLevel = ($level == 'jr' || $level == 'sr') ? 'elite' : 'jo';

		return Config::get(sprintf('app.compcards.source.%s.%s', $compcardLevel, $event));
	}
}