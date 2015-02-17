<?php

use LaravelBook\Ardent\Ardent;

class Administrador extends Ardent {

      public static $rules = array(
          'nombre' => 'required'
      );
      protected $table    = 'administradores';
      // Don't forget to fill this array
      protected $fillable = ['nombre'];
      public static $relationsData = array(
          'user'      => array(self::MORPH_ONE, 'User', 'name' => 'userable'),
      );
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;

}
