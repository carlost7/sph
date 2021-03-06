<?php

use LaravelBook\Ardent\Ardent;

/*
 * Modelo de Bd en donde se guardaran los datos de pago y los status 
 */

class Pago extends Ardent {

      public static $rules                 = array(
          'nombre'      => 'required',
          'descripcion' => 'required',
          'pagado'      => 'required',
          'metodo'      => '',
          'status'      => 'required',
      );
      protected $table                     = 'pagos';
      protected $fillable                  = ["nombre", "descripcion", "monto", "pagado", "metodo", "status"];
      public $autoPurgeRedundantAttributes = true;
      public static $relationsData         = array(
          'cliente' => array(self::BELONGS_TO, 'Cliente'),
          'pagable' => array(self::MORPH_TO)
      );

      public function afterUpdate()
      {
            if ($this->status == "approved")
            {
                  if (!count(Event::fire('pago_aprobado', array($this))))
                  {
                        return false;
                  }
            }
            elseif ($this->status == 'cancelled')
            {
                  if (!count(Event::fire('pago_cancelado', array($this))))
                  {
                        return false;
                  }
            }
      }

}
