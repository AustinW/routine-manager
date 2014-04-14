<?php

namespace Api;

use \User, \Validator, \Input, \Auth, \Response, \Lang;

class AccountController extends BaseController {
	
	protected $user;

	public function __construct(User $user)
	{
		parent::__construct();

		$this->user = $user;
	}

	public function postLogin()
	{
		$validation = Validator::make(Input::all(), ['email' => 'required|email', 'password' => 'required']);

		if ($validation->fails()) {
			return Response::apiValidationError($validation, Input::all(), Lang::get('auth.invalid'));
		}

		if (Auth::check()) {
			return Response::apiError('You are already logged in');
		}

		$credentials = [
			'email'    => Input::get('email'),
			'password' => Input::get('password')
		];

		$attempt = Auth::attempt($credentials, (bool) Input::get('remember'));

		if ($attempt) {

			$verified = Auth::user()->verified_at != null;
			
			if ( ! $verified) {
				Auth::logout();

				return Response::apiError('The account you\'re trying to login to has not been verified');
			} else {

				return Response::apiMessage('Login successful');
			}

		} else {
			Auth::logout();

			return Response::apiError('Login unsuccessful. Invalid credentials.', 401);
		}
	}

	public function getLogout()
	{
		Auth::logout();

		return Response::apiMessage('You have been logged out.');
	}

	public function postRegister()
	{
		$input = Input::all();

		$validation = Validator::make($input, [
			'email'      => 'required|email|unique:users|max:100',
			'password'   => 'required|confirmed',
			'first_name' => 'required|max:50',
			'last_name'  => 'required|max:50',
			'terms'      => 'accepted',
		]);

		if ($validation->fails()) {

			return Response::apiError($validation);

		} else {

			$newUser = $this->user->create([
				'email'      => $input['email'],
				'password'   => $input['password'],
				'first_name' => $input['first_name'],
				'last_name'  => $input['last_name']
			]);

			// Fire off an event that a user is registered (maybe fire off an email?)
			Event::fire('account.registered', [$newUser]);

			// Auth::login($newUser); // <-- must be verified first

			return Response::apiMessage('You have successfully registered and are now logged in.');
		}
	}
}