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
              'apellido' => 'required',
              'empresa' => 'required',
              'ext' => 'numeric',
              'telefono' => 'required',
              'celular' => 'required'
          ),
          "update" => array(
              'nombre' => 'required',
              'apellido' => 'required',
              'empresa' => 'required',
              'telefono' => 'numeric',
              'ext' => 'numeric',
              'celular' => 'required'
          ),
      );

}
