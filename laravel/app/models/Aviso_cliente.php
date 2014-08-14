<?php

/*
 * Modelo de base de datos en donde se guardarán los avisos del cliente
 * que despues revisarán los usuarios de marketing * 
 */

class Aviso_cliente extends \Eloquent
{

      protected $table = 'avisos_clientes';
      
      /*
       * Pertenece a un cliente 
       */
      public function cliente()
      {
            return $this->belongsTo('Cliente');
      }

      /*
       * Hace una relacion con:
       * Negocio
       * Evento
       * Promocion
       */
      public function avisable()
      {
            return $this->morphTo();
      }

}
