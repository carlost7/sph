<?php

namespace Sph\Services\Validators;

/**
 * Description of Administrador
 *
 * @author carlos
 */

class Administrador extends Validator
{

      public static $rules = array(
          "save" => array(              
              'nombre' => 'required',
          ),
          "update" => array(
              'nombre' => 'required',
          ),
      );

}
