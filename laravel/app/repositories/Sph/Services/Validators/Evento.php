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
              'horario' => 'required',
              'lugar' => 'required',
              'direccion' => 'required',
              'descripcion' => 'required|min:20|max:140',
              'telefono' => 'numeric',
              'estado' => 'required|exists:estados,id',
              'zona' => 'required|exists:zonas,id',
              'categoria' => 'required|exists:categorias,id',
              'subcategoria' => 'required|exists:subcategorias,id',
          ),
          "update" => array(
              'fecha_inicio' => array('required','after:Carbon\Carbon::now()'),
              'fecha_fin' => 'required|date|after:fecha_inicio',
              'horario' => 'required',
              'lugar' => 'required',
              'direccion' => 'required',
              'descripcion' => 'required|min:20|max:140',
              'telefono' => 'numeric',
              'estado' => 'required|exists:estados,id',
              'zona' => 'required|exists:zonas,id',
              'categoria' => 'required|exists:categorias,id',
              'subcategoria' => 'required|exists:subcategorias,id',
          ),
      );

}
