<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

// use Jenssegers\Mongodb\Model as Eloquent; // Use MongoDB

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

	public function name()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

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

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
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

	public function routines() { return $this->hasMany('Routine'); }

}