<?php

class AccountController extends BaseController {

	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function getIndex()
	{
		return View::make('account/index');
	}

	public function getLogin()
	{
		return View::make('account/login');
	}

	public function postLogin()
	{
		$validation = Validator::make(Input::all(), ['email' => 'required|email', 'password' => 'required']);

		if ($validation->fails()) {
			alert_error($validation->messages()->all());

			return Redirect::to('account/login');
		}

		if (Auth::check()) {
			alert_warning('You are already logged in');
			return Redirect::to('account');
		}

		$credentials = [
			'email'    => Input::get('email'),
			'password' => Input::get('password')
		];

		$login_attempt = Auth::attempt($credentials, (bool) Input::get('remember'));

		if ($login_attempt) {

			$verified = Auth::check() && Auth::user()->verified_at != null;
			
			if (!$verified) {
				Auth::logout();

				alert_error('The account you\'re trying to login to has not been verified.');

				return Redirect::to('account/login');
			} else {

				alert_success('Login successful');
				
				return Redirect::to('account');
			}

		} else {
			Auth::logout();

			alert_error('Login unsuccessful. Invalid credentials.');

			return Redirect::to('account/login');
		}
	}

	public function getLogout()
	{
		Auth::logout();

		alert_info('You have been logged out.');

		return Redirect::to('/');
	}

	public function getRegister()
	{
		return View::make('account/register');
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

			return Redirect::to('account/register')->withErrors($validation)->withInput($input);

		} else {

			$newUser = $this->user->create([
				'email'      => $input['email'],
				'password'   => $input['password'],
				'first_name' => $input['first_name'],
				'last_name'  => $input['last_name']
			]);

			// Fire off an event that a user is registered (maybe fire off an email?)
			Event::fire('account.registered', [$newUser]);

			Auth::login($newUser);

			alert_success('You have successfully registered and are now logged in.');

			return Redirect::to('/');
		}
	}
}