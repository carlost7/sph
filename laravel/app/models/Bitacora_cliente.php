<?php

use LaravelBook\Ardent\Ardent;

class Bitacora_cliente extends Ardent {

      protected $table                      = 'bitacora_clientes';
      protected $fillable                   = ['fecha', 'mensaje'];
      public static $rules                  = array(
          'fecha'   => 'required',
          'mensaje' => 'required',
      );
      public static $relationsData          = array(
          'cliente' => array(self::BELONGS_TO, 'Cliente'),
      );
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;

}
