<?php

class AthletesController extends BaseController
{
	protected $athleteRepository, $trampolineRoutineRepository;

	public function __construct(Athlete $athleteRepository, TrampolineRoutine $trampolineRoutineRepository)
	{
		$this->athleteRepository = $athleteRepository;
		$this->trampolineRoutineRepository = $trampolineRoutineRepository;

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
			return $this->athleteRepository->whereId($id)->whereUserId(Auth::user()->_id)->first();
		} else {
			return $this->athleteRepository->where('user_id', Auth::user()->_id)->whereNull('deleted_at')->get();
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
		$athlete = $this->athleteRepository->find($id);

		return ($athlete) ? $athlete : Response::json(['message' => 'Specified athlete (' . $id . ') could not be found.'], 404);
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

		$attributes = $athlete->getAttributes();

		foreach ($attributes as $key => $value) {
			if (Input::has($key)) $athlete->$key = Input::get($key);
		}

		if ($athlete->isInvalid()) return $athlete->errorResponse();

		$athlete->save();

		return $athlete;
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

		$athlete->{Input::get('which')} = $routine->_id;

		$athlete->save();

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