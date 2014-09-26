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
              'publicacion_inicio' => 'required_if:modificar_publicacion,1|date',
              'publicacion_fin' => 'required_if:modificar_publicacion,1|date|after:publicacion_inicio',              
              'tiempo_publicacion' => 'required_if:modificar_publicacion,1',
          ),
      );

}
