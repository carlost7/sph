<?php

use LaravelBook\Ardent\Ardent;

class Subcategoria extends Ardent {

      protected $fillable                   = ['subcategoria'];
      public static $rules                  = array(
          'subcategoria' => 'required',
      );
      public static $relationsData          = array(
          'categoria' => array(self::BELONGS_TO, 'Categoria'),
          'negocios'  => array(self::HAS_MANY, 'Negocio'),
          'eventos'   => array(self::HAS_MANY, 'Evento'),
      );
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;

}
