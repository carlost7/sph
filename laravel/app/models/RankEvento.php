<?php

use LaravelBook\Ardent\Ardent;

class RankEvento extends Ardent {

      protected $table                      = 'eventos_ranks';
      public static $rules                  = array(
          '' => '',
      );
      public static $relationsData          = array(
          'negocios'      => array(self::BELONGS_TO, 'Negocio'),
          'eventos'       => array(self::BELONGS_TO, 'Evento'),
      );
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;

      
}
