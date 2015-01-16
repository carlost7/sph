<?php

/*
 * Guarda Codigos promocionales que utilizara el usuario en vez de pago
 */

use LaravelBook\Ardent\Ardent;

class Codigo extends Ardent {

      protected $table = 'codigos';
      protected $fillable = ['numero', 'usado', 'cliente_id'];
      public static $relationsData = array(
          'cliente' => array(self::BELONGS_TO, 'Cliente'),
      );

}
