<?php

namespace Sph\Services\Validators;

use Carbon\Carbon;

class Publicacion extends Validator
{

      public static $rules = array(
          "save" => array(              
              'publicacion_inicio' => array('required','after:Carbon\Carbon::now()'),
              'publicacion_fin' => 'required|date|after:publicacion_inicio',             
              'tiempo_publicacion' => 'required',
          ),
          "update" => array(
              'publicacion_inicio' => array('required','after:Carbon\Carbon::now()'),
              'publicacion_fin' => 'required|date|after:publicacion_inicio',              
          ),
      );

}
