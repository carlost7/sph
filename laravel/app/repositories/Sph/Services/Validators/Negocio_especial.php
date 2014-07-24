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
class Negocio_especial extends Validator
{

// Add your validation rules here
      public static $rules = array(
          "update" => array(
              'horario'=>'numeric'
          )
      );

}
