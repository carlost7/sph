<?php

/*
 * Guarda Codigos promocionales que utilizara el usuario en vez de pago
 */
class Codigo extends \Eloquent
{

      protected $table = 'codigos';
      
      protected $fillable = ['numero', 'usado','cliente_id'];

      public function client()
      {
            return $this->belongsTo('Cliente', 'cliente_id', 'id');
      }

}
