<?php

class Athlete extends BaseModel
{

	protected $guarded = array();

	protected $softDelete = false;

	public $hidden = ['deleted_at'];

	public static $levels = [
		'0'  => 'None',
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

		'tra_prelim_compulsory'   => 'exists:trampoline_routines,_id',
		'tra_prelim_optional'     => 'exists:trampoline_routines,_id',
		'tra_semi_final_optional' => 'exists:trampoline_routines,_id',
		'tra_final_optional'      => 'exists:trampoline_routines,_id',

		'sync_prelim_compulsory' => 'exists:trampoline_routines,_id',
		'sync_prelim_optional'   => 'exists:trampoline_routines,_id',
		'sync_final_optional'    => 'exists:trampoline_routines,_id',



	];

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function traPrelimCompulsory()  { return $this->hasOne('Routines\TrampolineRoutine', 'tra_prelim_compulsory'); }
	public function traPrelimOptional()    { return $this->hasOne('Routines\TrampolineRoutine', 'tra_prelim_optional'); }
	public function traSemiFinalOptional() { return $this->hasOne('Routines\TrampolineRoutine', 'tra_semi_final_optional'); }
	public function traFinalOptional()     { return $this->hasOne('Routines\TrampolineRoutine', 'tra_final_optional'); }

	public function name() { return $this->first_name . ' ' . $this->last_name; }

	public function trampolineRoutines()
	{
		return $this->hasMany('TrampolineRoutine');
	}

	public function findCheckOwner($id)
	{
		if ( ! Auth::check()) {
			throw new Exception('Authenticated session must be established before accessing this method.');
		}

		return self::where('_id', $id)->where('user_id', Auth::user()->_id)->whereNull('deleted_at');
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
			$athletes[$athlete->_id] = $athlete->name;
		}

		return $athletes;
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