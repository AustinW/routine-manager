<?php

namespace Api;

use Controller;
use Auth;

class BaseController extends Controller {
	
	protected $user;

	public function __construct()
	{
		if (Auth::check())
			$this->user = Auth::user();
	}

	public function userId()
	{
		return $this->user->getKey();
	}
}