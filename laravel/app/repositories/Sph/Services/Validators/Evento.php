<?php

namespace Sph\Services\Validators;

use Carbon\Carbon;

class Evento extends Validator
{

      public static $rules = array(
          "save" => array(
              'nombre' => 'required',              
              'fecha_inicio' => array('required','after:Carbon\Carbon::now()'),
              'fecha_fin' => 'required|date|after:fecha_inicio',
              'hora_inicio' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'hora_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'lugar' => 'required',
              'direccion' => 'required',
              'descripcion' => 'required|min:20|max:140',
              'telefono' => 'required',              
          ),
          "update" => array(
              'fecha_inicio' => array('required','after:Carbon\Carbon::now()'),
              'fecha_fin' => 'required|date|after:fecha_inicio',
              'hora_inicio' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'hora_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'lugar' => 'required',
              'direccion' => 'required',
              'descripcion' => 'required|min:20|max:140',
              'telefono' => '',              
          ),
      );

}
