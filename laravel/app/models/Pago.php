<?php

/*
 * Modelo de Bd en donde se guardaran los datos de pago y los status 
 */
class Pago extends \Eloquent
{

      protected $table = 'pagos';
      
      protected $fillable = ["nombre", "descripcion", "monto", "pagado", "metodo", "status"];

      /*
       * un Pago pertenece a un cliente
       */
      public function cliente()
      {
            return $this->belongsTo('Cliente', 'cliente_id', 'id');
      }

      /*
       * Un pago es generado por diferntes tablas
       */
      public function pagable()
      {
            return $this->morphTo();
      }

}
