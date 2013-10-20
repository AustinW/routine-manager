<?php

class AccountController extends BaseController {

	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function postLogin()
	{
		$validation = Validator::make(Input::all(), ['email' => 'required|email', 'password' => 'required']);

		if ($validation->fails()) {
			return Response::json(['message' => $validation->messages()->all()], 412);
		}

		if (Auth::check()) {
			return Response::json(['message' => 'User is already logged in.'], 400);
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
				return Response::json(['message' => 'You must verify your account before logging in.'], 403);
			} else {
				return Response::json(['message' => 'Login successful.', 'user' => Auth::user()->toArray()]);
			}

		} else {
			Auth::logout();

			return Response::json(['message' => 'Login unsuccessful. Invalid credentials.'], 403);
		}
	}

	public function getLogout()
	{
		Auth::logout();

		return Response::json(['message' => 'Logout successful']);
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

			return Response::json(['message' => $validation->messages()->all()], 412);

		} else {

			$newUser = $this->user->create([
				'email'      => $input['email'],
				'password'   => $input['password'],
				'first_name' => $input['first_name'],
				'last_name'  => $input['last_name']
			]);

			// Fire off an event that a user is registered (maybe fire off an email?)
			Event::fire('account.registered', [$newUser]);

			return Response::json(['message' => 'Registration successful', 'id' => $newUser->_id], 201);
		}
	}
}