<?php

use LaravelBook\Ardent\Ardent;

class Zona extends Ardent {

      protected $fillable                   = ['zona'];
      public static $rules                  = array(
          'zona' => 'required',
      );
      public static $relationsData          = array(
          'estado'   => array(self::BELONGS_TO, 'Estado'),
          'negocios' => array(self::HAS_MANY, 'Negocio'),
          'eventos'  => array(self::HAS_MANY, 'Evento'),
      );
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;

}
