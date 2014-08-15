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

class MasinfoNegocio extends Validator
{
      public static $rules = array(
          "save" => array(
              'domicilio'=>'boolean',
              'llevar'=>'boolean',
              'moneda'=>'alpha|size:3',
              'efectivo'=>'boolean',
              'tc'=>'boolean',
              'td'=>'boolean',
              'rango_min'=>'numeric',
              'rango_max'=>'numeric',
              'familiar'=>'boolean',              
              'alcohol'=>'boolean',              
          ),
          "update" => array(
              'domicilio'=>'boolean',
              'llevar'=>'boolean',
              'moneda'=>'alpha|size:3',
              'efectivo'=>'boolean',
              'tc'=>'boolean',
              'td'=>'boolean',
              'rango_min'=>'numeric',
              'rango_max'=>'numeric',
              'familiar'=>'boolean',              
              'alcohol'=>'boolean',
          ),
      );
}
