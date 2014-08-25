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
class Pago extends Validator
{

      public static $rules = array(
          "save" => array(
              'nombre' => 'required',
              'descripcion' => 'required||min:30',
              'inicio' => 'required|date',
              'fin' => 'required|date',
          ),
          "update" => array(
              'direccion' => '',
              'descripcion' => 'min:30',
              'inicio' => 'date',
              'fin' => 'date',
          ),
      );

}
