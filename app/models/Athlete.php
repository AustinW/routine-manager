<?php

class Athlete extends BaseModel
{

	protected $guarded = array();

	protected $softDelete = true;

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

	public function user() { return $this->belongsTo('User'); }

	public function synchroPartner() { return $this->hasOne('Athlete', 'synchro_partner_id'); }

	public function trampolineRoutines()
	{
		return $this->belongsToMany('TrampolineRoutine', 'athlete_routine', 'athlete_id', 'routine_id')
			->withPivot('routine_type')
			->whereType('trampoline')
			->wherePivot('routine_type', '=', 'tra_prelim_compulsory')
			->orWherePivot('routine_type', '=', 'tra_prelim_optional')
			->orWherePivot('routine_type', '=', 'tra_semi_final_optional')
			->orWherePivot('routine_type', '=', 'tra_final_optional');
	}

	public function doubleminiPasses()
	{
		return $this->belongsToMany('DoubleminiPass', 'athlete_routine', 'athlete_id', 'routine_id')
			->withPivot('routine_type')
			->whereType('doublemini')
			->wherePivot('routine_type', '=', 'dmt_pass_1')
			->orWherePivot('routine_type', '=', 'dmt_pass_2')
			->orWherePivot('routine_type', '=', 'dmt_pass_3')
			->orWherePivot('routine_type', '=', 'dmt_pass_4');
	}

	public function tumblingPasses()
	{
		return $this->belongsToMany('TumblingPass', 'athlete_routine', 'athlete_id', 'routine_id')
			->withPivot('routine_type')
			->whereType('tumbling')
			->wherePivot('routine_type', '=', 'tum_pass_1')
			->orWherePivot('routine_type', '=', 'tum_pass_2')
			->orWherePivot('routine_type', '=', 'tum_pass_3')
			->orWherePivot('routine_type', '=', 'tum_pass_4');
	}

	public function scopeAllDoubleminiPasses($query)
	{
			
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

	public function setTrampolineLevelAttribute($value) { $this->attributes['trampoline_level'] = strtolower($value); }
	public function setSynchroLevelAttribute($value)    { $this->attributes['synchro_level']    = strtolower($value); }
	public function setDoubleminiLevelAttribute($value) { $this->attributes['doublemini_level'] = strtolower($value); }
	public function setTumblingLevelAttribute($value)   { $this->attributes['tumbling_level']   = strtolower($value); }

	public function ageGroup($year, $level)
	{
		if ($level == 'jr' || $level == 'sr')
			return null;

		$age = $year - (int) date('Y', strtotime($this->birthday));
		
		switch ($level)
		{
			case '9':
				if ($age <= 6)
					$category = '6 & under';
				else if ($age >= 7 && $age <= 8)
					$category = '7-8';
				else if ($age >= 9 && $age <= 10)
					$category = '9-10';
				else if ($age >= 11 && $age <= 12)
					$category = '11-12';
				else if ($age >= 13 && $age <= 14)
					$category = '13-14';
				else
					$category = '15 & over';
				break;
			case '10':
				if ($age <= 10)
					$category = '10 & under';
				else if ($age >= 11 && $age <= 12)
					$category = '11-12';
				else if ($age >= 13 && $age <= 14)
					$category = '13-14';
				else if ($age >= 15 && $age <= 16)
					$category = '15-16';
				else
					$category = '17 & over';
				break;
			default:
				$category = '';
				break;
		}
		return $category;
	}
}