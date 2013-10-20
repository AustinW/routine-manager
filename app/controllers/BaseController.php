<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout)
				->with('user_link', '<a href="' . URL::action('UserController@index') . '">' . Auth::user()->email . '</a>');
		}
	}

}