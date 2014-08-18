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
class Cliente extends Validator
{

      public static $rules = array(
          "save" => array(
              'nombre' => 'required',
              'apellido' => 'required|alpha',
              'empresa' => 'alpha',
              'ext' => 'numeric',
              'telefono' => 'required|numeric',
              'celular' => 'required|numeric'
          ),
          "update" => array(
              'nombre' => 'required',
              'apellido' => 'required|alpha',
              'empresa' => 'alpha',
              'telefono' => 'numeric',
              'ext' => 'numeric',
              'celular' => 'required|numeric'
          ),
      );

}
