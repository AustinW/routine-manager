<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

use Jenssegers\Mongodb\Model as Eloquent; // Use MongoDB

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $fillable = ['email', 'password', 'first_name', 'last_name'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

	/**
	 * Return a collection of athlete models for a given user.
	 *
	 * @return array
	 */
	public function athletes()
	{
		return $this->hasMany('Athlete');
	}

	public function trampolineRoutines()
	{
		return $this->hasMany('TrampolineRoutine');
	}

}