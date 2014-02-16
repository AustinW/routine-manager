<?php

namespace Compcard;

use Austinw\Pdfdf\Pdfdf;
use Routine;
use Athlete;
use Lang;
use Config;
use Exception;

class SynchroCompcard extends BaseCompcard
{
	protected $compcardType = 'synchro';

	public function __construct(Pdfdf $pdfdf, Athlete $athlete, CompcardMapper $compcardMapper)
	{
		if ( ! $athlete->synchroPartner) {
			throw new Exception(Lang::get('athlete.no_synchro_partner', array('name' => $athlete->name())));
		}

		parent::__construct($pdfdf, $athlete, $compcardMapper);
	}

	protected function mapCompcard(array $fields)
	{
		$this->compcardMapper->setGender(ucwords($this->athlete->gender[0]));
		$this->compcardMapper->setLevel(ucwords($this->athlete->synchro_level));

		$level = $this->athlete->synchro_level;
		$this->compcardMapper->setAgeGroup(Athlete::ageGroup(date('Y'), $level, $this->athlete->birthday));

		$this->compcardMapper->assignAthletesAndTeams($this->athlete);
		$this->mapRoutines($fields);

		foreach ($fields as $field) {
			$field->setValue($this->compcardMapper->getField($field->getName()));
		}
	}

	protected function mapRoutine(Routine $routine, array $fields, $routineType)
	{
		$this->compcardMapper->massAssign($routine, $routineType);

		if ($routineType == 'syn_prelim_compulsory') {

			if (strtolower($this->athlete->trampoline_level) == 'sr') {

			} else if (strtolower($this->athlete->trampoline_level) == 'jr') {

			}

		}
	}

	protected function mapRoutines(array $fields)
	{
		parent::mapEachRoutine($this->athlete->synchroRoutines, $fields);
	}

	protected function sourceCompcard($event)
	{
		$level = $this->athlete->synchro_level;
		$partnerLevel = $this->athlete->synchroPartner->synchro_level;

		if ($level == null)
			throw new Exception(Lang::get('athlete.invalid_level', array('name' => $this->athlete->name(), 'event' => 'synchro')));

		if ($partnerLevel == null)
			throw new Exception(Lang::get('athlete.invalid_level', array('name' => $this->athlete->synchroPartner->name(), 'event' => 'synchro')));

		if ($level != $partnerLevel)
			throw new Exception(Lang::get('athlete.synchro_mismatch', array(
				'partner1' => $this->athlete->name(),
				'partner2' => $this->athlete->synchroPartner->name(),
				'level1'   => $this->athlete->synchro_level,
				'level2'   => $this->athlete->synchroPartner->synchro_level,
			)));

		$compcardLevel = ($level == 'jr' || $level == 'sr') ? 'elite' : 'jo';

		return Config::get(sprintf('app.compcards.source.%s.%s', $compcardLevel, $event));
	}
}