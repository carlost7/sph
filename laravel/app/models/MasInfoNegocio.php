<?php

/*
 * Modelo de bd para guardar los datos adicionales de negocio
 */

use LaravelBook\Ardent\Ardent;

class MasInfoNegocio extends Ardent {

      protected $table                      = 'mas_info_negocios';
      protected $fillable                   = ["tc", "td", "estacionamiento", "valet",
          "envio_domicilio", "wifi", "paqueteria", "mascotas",
          "barra_libre", "formal", "camara_perm", "restaurante",
          "solo_mujeres", "solo_hombres", "personalizado",
          "taller", "clases_extra", "informacion", "lavanderia",
          "gimnasio", "membresia", "cafeteria",
          "pension", "cambios", "devoluciones", "bicicleta",
          "alcohol", "familiar", "cita", "pagos_diferidos",
          "facturacion", "mensajeria", "internacional"];
      public static $rules                  = array(
          "tc"              => "boolean",
          "td"              => "boolean",
          "estacionamiento" => "boolean",
          "valet"           => "boolean",
          "envio_domicilio" => "boolean",
          "wifi"            => "boolean",
          "paqueteria"      => "boolean",
          "mascotas"        => "boolean",
          "barra_libre"     => "boolean",
          "formal"          => "boolean",
          "camara_perm"     => "boolean",
          "restaurante"     => "boolean",
          "solo_mujeres"    => "boolean",
          "solo_hombres"    => "boolean",
          "personalizado"   => "boolean",
          "taller"          => "boolean",
          "clases_extra"    => "boolean",
          "informacion"     => "boolean",
          "lavanderia"      => "boolean",
          "gimnasio"        => "boolean",          
          "membresia"       => "boolean",
          "cafeteria"       => "boolean",
          "pension"         => "boolean",
          "cambios"         => "boolean",
          "devoluciones"    => "boolean",
          "bicicleta"       => "boolean",
          "alcohol"         => "boolean",
          "familiar"        => "boolean",
          "cita"            => "boolean",
          "pagos_diferidos" => "boolean",
          "facturacion"     => "boolean",
          "mensajeria"      => "boolean",
          "internacional"   => "boolean",
      );
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;
      public static $relationsData          = array(
          'negocio' => array(self::BELONGS_TO, 'Negocio'),
      );

}
