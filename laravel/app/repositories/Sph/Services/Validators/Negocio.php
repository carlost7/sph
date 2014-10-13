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
class Negocio extends Validator
{

// Add your validation rules here
      public static $rules = array(
          "save" => array(
              'nombre' => 'required',
              'direccion' => 'required',
              'telefono' => 'required',
              'descripcion' => 'required|min:30|max:500',              
          ),
          "update" => array(
              'telefono' => 'required',
              'descripcion' => 'required|min:30|max:500',              
          )
      );

}
