<?php

use LaravelBook\Ardent\Ardent;

/*
 * Modelo de Bd en donde se guardaran los datos de pago y los status 
 */

class Pago extends Ardent
{

      public static $rules = array(
            'nombre' => 'required',
            'descripcion' => 'required',
            'pagado' => 'required',
            'metodo' => 'required|min:30|max:500',
            'status' => 'required|email',
      );
      protected $table = 'pagos';
      protected $fillable = ["nombre", "descripcion", "monto", "pagado", "metodo", "status"];
      public $autoHydrateEntityFromInput = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes = true;
      public static $relationsData = array(
            'cliente' => array(self::BELONGS_TO, 'Cliente'),
            'pagable' => array(self::MORPH_TO)
      );

}
