<?php

namespace Sph\Services\Validators;

abstract class Validator
{

      protected $input;
      protected $errors;
      protected $action;

      public function __construct($input = NULL, $action = NULL)
      {
            $this->input = $input ? : \Input::all();
            $this->action = $action;
      }

      public function passes()
      {
            $validation = \Validator::make($this->input, static::$rules[$this->action]);

            if ($validation->passes())
                  return true;

            $this->errors = $validation->messages();

            return false;
      }

      public function getErrors()
      {
            return $this->errors;
      }

}
