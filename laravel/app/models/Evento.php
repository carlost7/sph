<?php

class Evento extends \Eloquent
{

      protected $table = 'eventos';
      // Don't forget to fill this array
      protected $fillable = ['nombre', 'direccion', 'descripcion', 'inicio', 'fin'];

      public function client()
      {
            return $this->belongsTo('Client', 'client_id', 'id');
      }

}
