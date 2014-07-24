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

      public function especial()
      {
            return $this->hasOne('Evento_especial','evento_id','id');
      }

      public function pago()
      {
            return $this->morphOne('Pago', 'pagable');
      }

}
