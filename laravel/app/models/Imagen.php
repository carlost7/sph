<?php

/*
 * Modelo de BD para guardar los datos de las imagenes
 */

use LaravelBook\Ardent\Ardent;

class Imagen extends Ardent {

      protected $table                      = 'imagenes';
      protected $fillable                   = ['path', 'nombre', 'alt'];
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;
      public static $rules                  = array(
          'nombre' => 'required',
          'alt'    => 'required',
          'imagen' => 'image|max:600'
      );
      public static $relationsData          = array(
          'masInfo' => array(self::MORPH_TO),
      );

}
