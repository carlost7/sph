<?php

namespace Sph\Services\Validators;


class Estado extends Validator
{

      public static $rules = array(
          "save" => array(
              'estado' => 'required|alpha',              
          ),
          "update" => array(
              'estado' => 'required|alpha',
          ),
      );

}
