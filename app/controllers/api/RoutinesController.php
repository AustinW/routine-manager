<?php

namespace Api;

// Routine Models
use Routine;

// Models
use \User, \Athlete, \Skill, \RoutineSkill;

// Laravel Facades
use \Validator, \Input, \Auth, \Response, \Lang, \Str;

// Laravel Classes
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\QueryException;

class RoutinesController extends BaseController
{

    protected $skillModel;
    protected $athleteModel;
    // protected $routineSkillModel;
    protected $routineModel;

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

    public function __construct(Skill $skill, Athlete $athlete, /*RoutineSkill $routineSkill,*/ Routine $routineModel)
    {
        $this->beforeFilter('auth');

        $this->skillModel             = $skill;
        $this->athleteModel           = $athlete;
        // $this->routineSkillModel      = $routineSkill;
        $this->routineModel = $routineModel;
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

        $invalidSkills = [];

        // Create an entry for each skill
        foreach (Input::get('skills', array()) as $skill)
        {
            if (Skill::invalidSkill($skill))
                $invalidSkills[] = $skill;
        }

        if (count($invalidSkills) > 0) {
            return Response::apiError(Lang::get('routine.invalid_skills', array('skills', implode(',', $invalidSkills))));
        }

        $user = Auth::user();

        // Initiate a routine model based on which type they selected
        $routine = $this->routineModel->fill(Input::only('name', 'description', 'type'));

        // Ensure the model is valid
        if ($routine->isInvalid()) {
            return $routine->errorResponse();
        }

        dd($routine);

        // Save the routine and associate it to the active user
        $user->{Input::get('routine_type') . 'Routines'}()->save($routine);

        // If an optional athlete was specified, create the association here
        if (Input::get('athlete_id') and ( $athlete = $this->athleteModel->findCheckOwner(Input::get('athlete_id'))->first() )) {

            $athleteRoutine = $this->athleteRoutineModel;
            $athleteRoutine->athlete_id = $athlete->id;

            $routine->athleteRoutines()->save($athleteRoutine);

        }

        // Re-evaluate to use Eloquent to relate the models properly
        $order = 1;
        foreach (Input::get('skills') as $skill) {
            $skill = $this->skillModel
                ->where('name', $this->skillModel->massageNameString($skill))
                ->orWhere('fig', $this->skillModel->massageFigString($skill))
                ->first();

            $this->routineSkillModel->

            $routine->routineSkills()->save($skill, [ 'order_index' => $order++ ]);
        }
        die;


    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show($id)
    {
        return Athlete::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update($id)
    {

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


    public function showSkills($id)
    {

        $routineType = Input::get('routineType');

        if (!$routineType)
            return Response::json(['message' => 'No routineType specified'], 400);

        $routine = $this->trampolineRoutineModel->with('routineSkills')->where('id', $id)->where('user_id', Auth::user()->id)->first();

        dd($routine);
    }

}