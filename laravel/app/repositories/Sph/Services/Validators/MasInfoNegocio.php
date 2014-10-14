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
class MasinfoNegocio extends Validator
{

      public static $rules = array(
          "save" => array(
              "efectivo" => "boolean",
              "tc" => "boolean",
              "td" => "boolean",
              "familiar" => "boolean",
              "estacionamiento" => "boolean",
              "valet_parking" => "boolean",
              "wifi" => "boolean",
              "mascotas"
          ),
          "update" => array(
              "efectivo" => "boolean",
              "tc" => "boolean",
              "td" => "boolean",
              "familiar" => "boolean",
              "estacionamiento" => "boolean",
              "valet_parking" => "boolean",
              "wifi" => "boolean",
              "mascotas"
          ),
      );

}
