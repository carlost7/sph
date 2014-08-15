<?php

namespace Sph\Services\Validators;

/**
 * Description of User
 *
 * @author carlos
 */

class Codigo extends Validator
{

      public static $rules = array(
          "save" => array(
              'numero' => 'required',              
          ),          
      );

}
