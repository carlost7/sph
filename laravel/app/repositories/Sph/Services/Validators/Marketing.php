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
class Marketing extends Validator
{

      public static $rules = array(
          "save" => array(
              'name' => 'required',
          ),
          "update" => array(
              'nombre' => ''
          ),
      );

}
