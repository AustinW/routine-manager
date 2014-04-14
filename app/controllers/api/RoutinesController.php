<?php

namespace Api;

// Routine Models
use Routine;

// Models
use \User, \Athlete, \Skill;

// Laravel Facades
use \Validator, \Input, \Auth, \Response, \Lang, \Str;

// Laravel Classes
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

class RoutinesController extends BaseController
{

    protected $skillRepository;
    protected $athleteRepository;
    protected $routineRepository;

    public static $rules = array(
        'first_name'       => 'required|max:50',
        'last_name'        => 'required|max:50',
        'birthday'         => 'required|date',
        'gender'           => 'required|in:male,female',
        'trampoline_level' => 'in:0,8,9,10,jr,sr',
        'doublemini_level' => 'in:0,8,9,10,jr,sr',
        'tumbling_level'   => 'in:0,8,9,10,jr,sr',
        'synchro_level'    => 'in:0,8,9,10,jr,sr',
    );

    public function __construct(Skill $skillRepository, Athlete $athleteRepository, Routine $routineRepository)
    {
        $this->beforeFilter('auth');

        $this->skillRepository   = $skillRepository;
        $this->athleteRepository = $athleteRepository;
        $this->routineRepository = $routineRepository;
    }

    public function index()
    {
        $routines = Auth::user()->routines()->get();
        
        return compact('routines');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validation = Validator::make(Input::only('skills'), array('skills' => 'required'));

        if ($validation->fails()) {
            return Response::apiValidationError($validation, Input::all());
        }

        $invalidSkills = Skill::checkForErrors(Input::get('skills'), array());

        if (count($invalidSkills) > 0) {
            return Response::apiError(Lang::get('routine.invalid_skills', array('skills', implode(',', $invalidSkills))));
        }

        // Initiate a routine model based on which type they selected
        $routine = $this->routineRepository->fill(Input::only('name', 'description', 'type'));

        // Ensure the model is valid
        if ($routine->isInvalid()) {
            return $routine->errorResponse();
        }

        // Save the routine and associate it to the active user
        $this->user->routines()->save($routine);

        // If an optional athlete was specified, create the association here
        if (Input::get('athlete_id') and ( $athlete = $this->athleteRepository->findCheckOwner(Input::get('athlete_id'))->first() )) {

            // $athleteRoutine = $this->athleteRoutineModel;
            // $athleteRoutine->athlete_id = $athlete->id;

            // $routine->athleteRoutines()->save($athleteRoutine);

        }

        $skillsCollection = $routine->attachSkills(Input::get('skills'));

        $routinesArray = $routine->toArray();
        $routinesArray['skills'] = $skillsCollection->toArray();

        return $routinesArray;

    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show($id)
    {
        $routine = $this->routineRepository->findCheckOwner($id)->first();

        return ($routine) ? compact('routine') : Response::apiError(Lang::get('routine.not_found'), 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update($id)
    {
        $invalidSkills = Skill::checkForErrors(Input::get('skills'), array());

        if (count($invalidSkills) > 0) {
            return Response::apiError(Lang::get('routine.invalid_skills', array('skills', implode(',', $invalidSkills))));
        }

        // Initiate a routine model based on which type they selected
        $routine = $this->routineRepository->findCheckOwner($id, $this->routineRepository->with('skills'))->first();

        $attributes = array('name', 'description', 'type');

        foreach ($attributes as $key) {
            if (Input::has($key)) $routine->$key = Input::get($key);
        }

        // Ensure the model is valid
        if ($routine->isInvalid()) {
            return $routine->errorResponse();
        }

        $routine->save();

        $skillsCollection = $routine->skills;

        if (Input::has('skills')) {

            // Remove existing skills from routine
            $skillsCollection->detach();
            
            $skillsCollection = $routine->attachSkills(Input::get('skills'));
        }

        $routinesArray = $routine->toArray();
        $routinesArray['skills'] = $skillsCollection->toArray();

        return $routinesArray;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy($id)
    {
        $athlete = Athlete::whereId($id)->whereUserId(Auth::user()->id)->first();
        $athleteName = $athlete->name();

        //@todo: Should not need to suppress error here. Bug in L4
        @$athlete->delete();

        return Response::json(['message' => $athleteName . ' deleted.']);
    }


    public function getSkills($id)
    {
        return $this->routineRepository->findCheckOwner($id, $this->routineRepository->with('skills'))->first()->skills;
    }

}