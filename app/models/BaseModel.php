<?php

// use Jenssegers\Mongodb\Model as Eloquent;

class BaseModel extends Eloquent
{
    public $validation;

    public static $rules = null;

    // protected $primaryKey = '_id';

    public function findCheckOwner($id)
    {
        if ( ! Auth::check()) {
            throw new Exception('Authenticated session must be established before accessing this method.');
        }

        return self::where($this->getKeyName(), $id)->where('user_id', Auth::user()->getKey())->whereNull('deleted_at');
    }

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
                'message' => Lang::get('validation.generic_error'),
                'errors'  => [
                    'fields' => array_keys($this->validation->failed()),
                    'messages' => $this->validation->messages()->all(),
                ],
                'values'  => $this->attributes
            ], 400);
        }
    }

    public function apiErrorResponse()
    {
        if ($this->validation->fails()) {
            return Response::apiValidationError($this->validation, $this->attributes);
        }
    }

    public function rules()
    {
        return static::$rules;
    }
}