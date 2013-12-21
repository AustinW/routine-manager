<?php

class RoutinesController extends BaseController
{

    protected $skillModel;
    protected $athleteModel;
    protected $athleteRoutineModel;
    protected $routineSkillModel;
    protected $trampolineRoutineModel;

    public static $rules = [
        'first_name'       => 'required|max:50',
        'last_name'        => 'required|max:50',
        'birthday'         => 'required|date',
        'gender'           => 'required|in:male,female',
        'trampoline_level' => 'in:0,8,9,10,jr,sr',
        'doublemini_level' => 'in:0,8,9,10,jr,sr',
        'tumbling_level'   => 'in:0,8,9,10,jr,sr',
        'synchro_level'    => 'in:0,8,9,10,jr,sr',
    ];

    public function __construct(Skill $skill, Athlete $athlete, AthleteRoutine $athleteRoutine, RoutineSkill $routineSkill, TrampolineRoutine $trampolineRoutine)
    {
        $this->beforeFilter('auth');

        $this->skillModel             = $skill;
        $this->athleteModel           = $athlete;
        $this->athleteRoutineModel    = $athleteRoutine;
        $this->routineSkillModel      = $routineSkill;
        $this->trampolineRoutineModel = $trampolineRoutine;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null)
    {
        $routines = Auth::user()->trampolineRoutines()->get();

        $routines->load('routineSkills');

        dd($routines);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validation = Validator::make(Input::all(), [
            'routine_type' => 'required|in:trampoline,doublemini,tumbling,synchro',

            // Ensure that if an athlete id is specified, it exists and belongs
            // to the current user
            'athlete_id'   => 'integer|exists:athletes,id,user_id,' . Auth::user()->id
        ]);

        if ($validation->fails()) {
            return Response::json(['message' => $validation->messages()->all()]);
        }

        $invalidSkills = [];

        // Create an entry for each skill
        foreach (Input::get('skills') as $skill)
        {
            if (!Skill::validSkill($skill))
                $invalidSkills[] = $skill;
        }

        if (count($invalidSkills) > 0) {
            return Response::json(['message' => 'Invalid skills', 'skills' => $invalidSkills], 400);
        }

        $user = Auth::user();

        // Initiate a routine model based on which type they selected
        $routine = App::make(ucwords(Input::get('routine_type')) . 'Routine');
        $routine->fill(Input::only('name', 'description'));

        // Ensure the model is valid
        if ($routine->isInvalid()) {
            return $routine->errorResponse();
        }

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