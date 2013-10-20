<?php

use Jenssegers\Mongodb\Model as Eloquent;

class BaseModel extends Eloquent
{
    public $validation;

    public static $rules = null;

    public function isValid()
    {
        $this->validation = Validator::make($this->attributes, static::$rules);

        if ($this->validation->passes()) return true;

        return false;
    }

    public function isInvalid()
    {
        return ! $this->isValid();
    }

    public function changeValidation($requestType)
    {
        self::$rules = $this->{$requestType . 'Rules'};
    }

    public function errorResponse()
    {
        if ($this->validation == null) $this->isValid();

        if ($this->validation->fails()) {
            return Response::json([
                'message' => 'Unable to create/modify the model. Please check errors.',
                'errors'  => [
                    'fields' => array_keys($this->validation->failed()),
                    'messages' => $this->validation->messages()->all(),
                ],
                'values'  => $this->attributes
            ], 400);
        }
    }
}