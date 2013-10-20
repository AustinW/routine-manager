<?php

class AthleteRoutine extends BaseModel
{
	protected $table = 'athlete_routines';

    protected $fillable = ['athlete_id', 'routineable_id', 'routineable_type'];

	public function athlete()
	{
		return $this->belongsTo('Athlete');
	}

	public function routineable()
	{
		return $this->morphTo();
	}
}