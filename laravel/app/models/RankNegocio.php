<?php

use LaravelBook\Ardent\Ardent;

class RankNegocio extends Ardent {

      protected $table                      = 'negocios_ranks';
      public static $rules                  = array(
          '' => '',
      );
      public static $relationsData          = array(
          'negocio' => array(self::BELONGS_TO, 'Negocio'),
          'miembro' => array(self::BELONGS_TO, 'Miembro'),
      );
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;

}
