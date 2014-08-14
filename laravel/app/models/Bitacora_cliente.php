<?php

/*
 * Modelo de DB para guardar las respuesta del cliente
 */
class Bitacora_cliente extends \Eloquent
{

      protected $table = 'bitacora_clientes';
      
      protected $fillable = ['fecha', 'mensaje'];

      public function cliente()
      {
            return $this->belongsTo('Clientee', 'cliente_id', 'id');
      }

}
