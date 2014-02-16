<?php

namespace Api;

use Athlete;

use Validator, Input, Response, Str;

use Chumper\Zipper\Zipper;

class CompcardController extends BaseController
{
	protected $athleteRepository;

	/* @var $zip Chumper\Zipper\Zipper */
	protected $zip;

	public function __construct(Athlete $athleteRepository, Zipper $zip)
	{
		parent::__construct();

		$this->athleteRepository = $athleteRepository;

		$this->zip = $zip;

		$this->beforeFilter('auth');
	}

	public function getDownload()
	{
		// Check to make sure the athletes GET variable is a set of comma-separated values
		$validation = Validator::make(Input::all(), array('athletes' => 'required|csv'));

		if ($validation->fails()) {
			return Response::apiValidationError($validation, Input::all());
		}

		$athleteIds = csv_to_array(Input::get('athletes'));

		// Get an array of athlete objects
		$athletes = $this->athleteRepository->whereIn('id', $athleteIds)->get();

		$zipFileName = 'compcards' . DIRECTORY_SEPARATOR . Str::slug($this->user->name() . '-compcards-' . Str::random(5)) . '.zip';

		// If we have at least one athlete, create a zip file
		if (count($athletes)) {
			$this->zip->make($zipFileName);
		}

		// Store a temporary array of the pdf files that are generated 
		$pdfFiles = array();

		// Loop through each of the athletes
		foreach ($athletes as $athlete) {

			// Create a folder for each of the athletes
			$this->zip->folder($athlete->name());
			
			// Generate each athlete's compcards for the events they have a level in
			$compcards = $athlete->generateCompcards($athlete->events());

			// Add each compcard to the zip file
			foreach ($compcards as $compcard) {
				$this->zip->add($compcard->getPdfFileName());
				$pdfFiles[] = $compcard->getPdfFileName();
			}
		}

		// Write out the zip file
		$this->zip->close();

		// Delete all the temporary pdf compcards
		foreach ($pdfFiles as $f) unlink($f);

		return Response::download($zipFileName);
	}
}