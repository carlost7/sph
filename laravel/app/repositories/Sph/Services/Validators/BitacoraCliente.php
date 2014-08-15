<?php

namespace Sph\Services\Validators;


class BitacoraCliente extends Validator
{

      public static $rules = array(
          "save" => array(
              'fecha' => 'required',
              'mensaje' => 'required',              
          ),
          "update" => array(
              'fecha' => 'required',
              'mensaje' => 'required',              
          ),
      );

}
