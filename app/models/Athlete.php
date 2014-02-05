<?php

class Athlete extends BaseModel
{

	protected $guarded = array();

	protected $softDelete = false;

	public $hidden = ['deleted_at'];

	public static $levels = [
		'0'  => 'None',
		'1'  => '1',
		'2'  => '2',
		'3'  => '3',
		'4'  => '4',
		'5'  => '5',
		'6'  => '6',
		'7'  => '7',
		'8'  => '8',
		'9'  => '9',
		'10' => '10',
		'jr' => 'Junior',
		'sr' => 'Senior',
	];

	public static $rules = [
		'first_name'       => 'required|max:50',
		'last_name'        => 'required|max:50',
		'team'             => 'required|max:50',
		'birthday'         => 'required|date',
		'gender'           => 'required|in:male,female',
		'trampoline_level' => 'in:0,8,9,10,jr,sr',
		'doublemini_level' => 'in:0,8,9,10,jr,sr',
		'tumbling_level'   => 'in:0,8,9,10,jr,sr',
		'synchro_level'    => 'in:0,8,9,10,jr,sr',

		// 'tra_prelim_compulsory'   => 'exists:trampoline_routines,_id',
		// 'tra_prelim_optional'     => 'exists:trampoline_routines,_id',
		// 'tra_semi_final_optional' => 'exists:trampoline_routines,_id',
		// 'tra_final_optional'      => 'exists:trampoline_routines,_id',

		// 'sync_prelim_compulsory' => 'exists:trampoline_routines,_id',
		// 'sync_prelim_optional'   => 'exists:trampoline_routines,_id',
		// 'sync_final_optional'    => 'exists:trampoline_routines,_id',



	];

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function routines()
	{
		return $this->belongsToMany('Routine')->withPivot('routine_type');
	}

	public function findWithRelationAndCheckOwner($relation, $id, \User $user)
	{
		return self::with((array) $relation)
			->where($this->getKeyName(), $id)
			->where('user_id', $user->getKey())
			->whereNull('deleted_at')
			->first();
	}

	public function name() { return $this->first_name . ' ' . $this->last_name; }

	public function trampolineRoutines()
	{
		return $this->hasMany('TrampolineRoutine');
	}

	public function excludeAthlete($athletes, $id)
	{
		$athletes->pop($id);

		return $athletes;
	}

	public function synchroPartnerArray($collection, $withEmpty = true)
	{
		$athletes = ($withEmpty) ? ['' => 'None'] : [];

		foreach ($collection as $athlete) {
			$athletes[$athlete->getKey()] = $athlete->name;
		}

		return $athletes;
	}

	public function possessive()
	{
		return ($this->gender == 'male') ? 'his' : 'her';
	}

	// public function getBirthdayAttribute($value)
	// {
	// 	return new DateTime($value);
	// }

	// public function setBirthdayAttribute($value)
	// {
	// 	if ($value instanceof DateTime) {
	// 		$this->attributes['birthday'] = $value->format('Y-m-d g:i:s');
	// 	} else {
	// 		$this->attributes['birthday'] = $value;
	// 	}
	// }
}