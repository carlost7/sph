<?php

use LaravelBook\Ardent\Ardent;

class Aviso_cliente extends Ardent {

      protected $table = 'avisos_clientes';
      public static $rules = array(
          '' => ''
      );
      public static $relationsData = array(
          'cliente' => array(self::BELONGS_TO, 'Cliente'),
          'avisable' => array(self::MORPH_TO)
      );
      protected $fillable                   = ['nombre'];
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;
      

}
