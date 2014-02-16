<?php

Response::macro('apiError', function($message = '', $code = 400)
{
	return Response::json(array(
		'status'  => 'error',
		'code'    => $code,
		'message' => $message ?: 'An unexpected error occurred.'
	), $code);
});

Response::macro('apiNotFoundError', function($message = '', $code = 404) {
	return Response::apiError($message, $code);
});

Response::macro('apiValidationError', function(\CustomValidator $validation, array $values, $message = '', $code = 400)
{
	$message = $message ?: Lang::get('validation.generic_error');

	return Response::json([
		'status'  => 'error',
	    'message' => $message,
	    'values'  => $values,
	    'errors'  => [
	        'fields'   => array_keys($validation->failed()),
	        'messages' => $validation->messages()->all(),
	    ],
	], $code);
});

Response::macro('apiExceptionError', function(\Exception $e, $code = 400) {

	return Response::apiError($e->getMessage(), $code);
	
});

Response::macro('apiMessage', function($message, $data = array(), $code = 200)
{
    	
	return Response::json(array(
		'status'  => 'success',
		'code'    => $code,
		'message' => $message,
		'data'    => $data
	), $code);

});

Validator::extend('csv', function($attribute, $value, $parameters)
{
    return (is_numeric($value) || preg_match('/\A\w+(,\w+)*\z/', str_replace(' ', '', $value)));
});