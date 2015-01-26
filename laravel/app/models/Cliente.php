<?php

use LaravelBook\Ardent\Ardent;

class Cliente extends Ardent {

      protected $table                      = 'clientes';
      protected $fillable                   = ['nombre', 'apellido', 'empresa', 'telefono', 'ext', 'celular', 'token'];
      public static $rules                  = array(
          'nombre'   => 'required',
          'apellido' => 'required',
          'empresa'  => 'required',
          'ext'      => 'numeric',
          'telefono' => 'required',
          'celular'  => 'required'
      );
      public static $relationsData          = array(
          'marketing' => array(self::BELONGS_TO, 'Marketing'),
          'negocios'  => array(self::HAS_MANY, 'Negocio'),
          'eventos'   => array(self::HAS_MANY, 'Evento'),
          'pagos'     => array(self::HAS_MANY, 'Pago'),
          'bitacoras' => array(self::HAS_MANY, 'Bitacora_cliente'),
          'avisos'    => array(self::HAS_MANY, 'Avisos'),
          'user'      => array(self::MORPH_ONE, 'User', 'name' => 'userable'),
      );
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;

      public function promociones()
      {
            return $this->hasManyThrough('Promocion', 'Negocio');
      }
      

}
