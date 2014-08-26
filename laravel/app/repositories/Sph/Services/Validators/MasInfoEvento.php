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

class MasinfoEvento extends Validator
{

      public static $rules = array(
          "save" => array(
              'moneda'=>'alpha|size:3',
              'costo'=>'numeric',
              'min_edad'=>'numeric|between:1,99',
              'max_edad'=>'numeric|between:1,99',
              'alcohol'=>'boolean',
              'tc'=>'boolean',
              'td'=>'boolean',
              'efectivo'=>'boolean',
              'otra'=>'alpha'
          ),
          "update" => array(
              'moneda'=>'size:3',
              'costo'=>'numeric',
              'min_edad'=>'numeric|max:99',
              'max_edad'=>'numeric|max:99',
              'alcohol'=>'boolean',
              'tc'=>'boolean',
              'td'=>'boolean',
              'efectivo'=>'boolean',
              'otra'=>'alpha'
          ),
      );

}
