<?php

use LaravelBook\Ardent\Ardent;

class MasInfoEvento extends Ardent {

      protected $table                      = 'mas_info_eventos';
      protected $fillable                   = ['moneda', 'costo', 'min_edad', 'max_edad', 'alcohol', 'tc', 'td', 'efectivo'];
      public static $rules                  = array(
          'moneda'   => 'alpha',
          'costo'    => 'numeric',
          'min_edad' => 'numeric',
          'max_edad' => 'numeric',
          'alcohol'  => 'boolean',
          'tc'       => 'boolean',
          'td'       => 'boolean',
          'efectivo' => 'boolean'
      );
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;
      public static $relationsData          = array(
          'evento' => array(self::BELONGS_TO, 'Evento'),
      );

}
