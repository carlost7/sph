<?php

namespace Sph\Services\Validators;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author carlos
 */
use Carbon\Carbon;

class Categoria extends Validator
{

      public static $rules = array(
          "save" => array(              
              'categoria' => 'required',
          ),
          "update" => array(
              'categoria' => 'required',
          ),
      );

}
