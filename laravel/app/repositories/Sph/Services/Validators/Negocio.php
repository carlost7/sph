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
class Negocio extends Validator
{

// Add your validation rules here
      public static $rules = array(
          "save" => array(
              'nombre' => 'required',
              'direccion' => 'required',
              'telefono' => 'required',
              'descripcion' => 'required|min:20|max:140',
              'estado' => 'required|exists:estados,id',
              'zona' => 'required|exists:zonas,id',
              'categoria' => 'required|exists:categorias,id',
              'subcategoria' => 'required|exists:subcategorias,id',
          ),
          "update" => array(
              'telefono' => 'numeric',
              'descripcion' => 'required|min:20|max:140',
              'estado' => 'required|exists:estados,id',
              'zona' => 'required|exists:zonas,id',
              'categoria' => 'required|exists:categorias,id',
              'subcategoria' => 'required|exists:subcategorias,id',
          )
      );

}
