<?php

use \Routines\TrampolineRoutine;
use \Routines\DoubleMiniPass;
use \Routines\TumblingPass;
use \Routines\SynchroRoutine;
use \Routines\BaseRoutine;

class AthletesController extends BaseController
{
	protected $athleteRepository;

	protected $trampolineRoutineRepository, $doubleMiniPassRepository, $tumblingPassRepository, $synchroRoutineRepository;

	public function __construct(Athlete $athleteRepository, TrampolineRoutine $trampolineRoutineRepository, DoubleMiniPass $doubleMiniPassRepository, TumblingPass $tumblingPassRepository, SynchroRoutine $synchroRoutineRepository)
	{
		$this->athleteRepository           = $athleteRepository;

		$this->trampolineRoutineRepository = $trampolineRoutineRepository;
		$this->doubleMiniPassRepository    = $doubleMiniPassRepository;
		$this->tumblingPassRepository      = $tumblingPassRepository;
		$this->synchroRoutineRepository    = $synchroRoutineRepository;

		$this->beforeFilter('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id = null)
	{
		if ($id) {
			$athlete = $this->athleteRepository->whereId($id)->whereUserId(Auth::user()->_id)->first();

			return View::make('athletes/viewOne')->with('athlete', $athlete);
		} else {
			$athletes = $this->athleteRepository->where('user_id', Auth::user()->_id)->whereNull('deleted_at')->get();

			return View::make('athletes/viewMany')->with('athletes', $athletes);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$newAthlete = $this->athleteRepository;

		$newAthlete->fill(Input::only('first_name', 'last_name', 'birthday', 'gender', 'trampoline_level', 'doublemini_level', 'tumbling_level', 'synchro_level'));

		if ($newAthlete->isInvalid()) {
			return $newAthlete->errorResponse();
		}

		$newAthlete->user_id = Auth::user()->id;
		$newAthlete->save();

		if ($newAthlete) {
			return Response::json(['message' => 'Athlete created.', 'id' => $newAthlete->_id], 201);
		} else {
			return Response::json(['message' => 'Problem creating athlete'], 500);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$athlete = $this->athleteRepository->findCheckOwner($id)->first();

		if ($athlete) {

			if ($athlete->trampoline_level) {
				$athlete->traPrelimCompulsory()->get();
				$athlete->traPrelimOptional()->get();
				$athlete->traSemiFinalOptional()->get();
				$athlete->traFinalOptional()->get();
			}

			return View::make('athletes/viewOne')->with('athlete', $athlete);

		} else {

			return View::make('athletes/error')->with('message', Lang::get('athlete.not_found'));
		}

	}

	public function edit($id)
	{
		$athlete = $this->athleteRepository->findCheckOwner($id)->first();
		$synchroPartners = $this->athleteRepository->synchroPartnerArray(
			$this->athleteRepository->excludeAthlete(Auth::user()->athletes()->get(), Auth::user()->_id)
		);
		
		$trampolineRoutines = $this->trampolineRoutineRepository->routinesForUser(Auth::user()->_id)->get();
		$doubleMiniPasses = $this->doubleMiniPassRepository->routinesForUser(Auth::user()->_id)->get();
		$tumblingPasses = $this->tumblingPassRepository->routinesForUser(Auth::user()->_id)->get();

		return View::make('athletes/edit')->with([
			'athlete'            => $athlete,
			'synchroPartners'    => $synchroPartners,
			'trampolineRoutines' => $this->trampolineRoutineRepository->simpleRoutineArray($trampolineRoutines),
			'doubleMiniPasses'   => $this->doubleMiniPassRepository->simpleRoutineArray($doubleMiniPasses),
			'tumblingPasses'     => $this->tumblingPassRepository->simpleRoutineArray($tumblingPasses),
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		$athlete = $this->athleteRepository->find($id);

		if ( ! $athlete) return Response::json(['message' => 'Specified athlete (' . $id . ') could not be found.'], 404);

		$attributes = array_keys(Athlete::$rules);

		foreach ($attributes as $key) {
			if (Input::has($key)) $athlete->$key = Input::get($key);
		}

		if ($athlete->isInvalid()) return $athlete->errorResponse();

		$athlete->save();

		alert_success($athlete->name() . ' has been updated.');

		return Redirect::route('athletes.show', $athlete->_id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$athlete = $this->athleteRepository->whereId($id)->whereUserId(Auth::user()->id)->first();
		$athleteName = $athlete->name();

		//@todo: Should not need to suppress error here. Bug in L4
		@$athlete->delete();

		return Response::json(['message' => $athleteName . ' deleted.']);
	}

	public function putAssociate($athleteId, $event, $routineId)
	{
		$validation = Validator::make(Input::only('which'), [
			'which' => 'required|in:' . implode(',', BaseRoutine::$whichRoutineFields)
		]);

		if ($validation->fails()) {
			return Response::json(['message' => $validation->messages()->all()]);
		}

		$repository = $this->eventToRepository($event);

		$routine = $repository
			->find($routineId)
			->where('user_id', Auth::user()->_id)
			->whereNull('deleted_at')
			->first();

		if ( ! $routine)
			return Response::json(['message' => 'Problem retrieving the routine specified.'], 401);

		$athlete = Auth::user()->athletes()
			->where('_id', $athleteId)
			->whereNull('deleted_at')
			->first();

		if ( ! $athlete)
			return Response::json(['message' => 'Problem retrieving the athlete specified.'], 401);

		$key = 'athlete' . ucwords(Str::camel(Input::get('which')));
		$routine->$key()->save($athlete);
		// $athlete->{Str::camel(Input::get('which'))}()->save($routine);

		return $athlete;
	}

	public function eventToRepository($event)
	{
		switch ($event) {
			case 'trampoline':
				return $this->trampolineRoutineRepository;
			case 'doublemini':
				return $this->doubleMiniPassRepository;
			case 'tumbling':
				return $this->tumblingPassRepository;
			case 'synchro':
				return $this->synchroRoutineRepository;
		}

		throw new \Exception("Event repository not found: " . $event);
	}

}