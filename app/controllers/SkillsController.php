<?php

class SkillsController extends BaseController {

	protected $skillRepository;

	public function __construct(Skill $skillRepository)
	{
		$this->skillRepository = $skillRepository;

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($skillName)
	{
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($skillName)
	{
		$skill = $this->skillRepository->fuzzyFind($skillName);

		return ($skill) ? $skill : Response::json(['message' => 'Skill not found'], 404);
	}

	public function getValid()
	{
		return ['valid' => $this->skillRepository->validSkill(Input::get('name'))];
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}