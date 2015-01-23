<?php

use LaravelBook\Ardent\Ardent;

class Marketing extends Ardent {

      protected $table                      = 'marketings';
      protected $fillable                   = ['name'];
      public static $rules                  = array(
          'name' => 'required',
      );
      public static $relationsData          = array(
          'user'      => array(self::MORPH_TO),
          'clientes'       => array(self::HAS_MANY, 'Cliente'),
      );
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;

}
