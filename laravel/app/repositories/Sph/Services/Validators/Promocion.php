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
class Promocion extends Validator
{

      public static $rules = array(
          "save" => array(
              'nombre' => 'required',
              'codigo' => 'required|alpha_dash',
              'descripcion' => 'required|min:20|max:140',
              'vigencia_inicio' => array('required','after:Carbon\Carbon::now()'),
              'vigencia_fin' => 'required|date|after:vigencia_inicio',
              'negocio'=>'required|exists:negocios,id',
          ),
          "update" => array(
              'direccion' => '',
              'descripcion' => 'required|min:20|max:140',
              'inicio' => 'date',
              'fin' => 'date',
          ),
      );

}
