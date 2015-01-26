<?php

use LaravelBook\Ardent\Ardent;

class Estado extends Ardent {

      protected $table                      = 'estados';
      protected $fillable                   = ['estado'];
      public static $rules                  = array(
          'estado' => 'required',
      );
      public static $relationsData          = array(
          'negocios' => array(self::HAS_MANY, 'Negocio'),
          'eventos'  => array(self::HAS_MANY, 'Evento'),
          'zonas'    => array(self::HAS_MANY, 'Zona'),
      );
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;

}
