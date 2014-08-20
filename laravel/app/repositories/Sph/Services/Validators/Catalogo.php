<?php

namespace Sph\Services\Validators;


/**
 * Description of Buscador
 *
 * @author carlos
 */
class Catalogo extends Validator
{
      public static $rules = array(
          "save" => array(              
              'categoria' => 'required|exists:categoria,id',
              'subcategoria' => 'required|exists:subcategoria,id',
              'estado' => 'required|exists:estado,id',
              'zona' => 'required|exists:zona,id',
          ),
          "update" => array(
              'categoria' => 'required|exists:categoria,id',
              'subcategoria' => 'required|exists:subcategoria,id',
              'estado' => 'required|exists:estado,id',
              'zona' => 'required|exists:zona,id',
          ),
      );
}
