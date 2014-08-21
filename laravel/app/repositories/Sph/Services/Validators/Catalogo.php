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
              'categoria' => 'required|exists:categorias,id',
              'subcategoria' => 'required|exists:subcategorias,id',
              'estado' => 'required|exists:estados,id',
              'zona' => 'required|exists:zonas,id',
          ),
          "update" => array(
              'categoria' => 'required|exists:categorias,id',
              'subcategoria' => 'required|exists:subcategorias,id',
              'estado' => 'required|exists:estados,id',
              'zona' => 'required|exists:zonas,id',
          ),
      );
}
