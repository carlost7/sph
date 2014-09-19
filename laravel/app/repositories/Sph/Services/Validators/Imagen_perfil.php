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

class Imagen_perfil extends Validator
{

      public static $rules = array(
          "save" => array(
              'alt' => '',
              'imagen' => 'image|max:600'
              
          ),
          "update" => array(
              'alt' => '',
              'imagen' => 'image|max:600'
          ),
      );

}
