<?php

class Promocion extends \Eloquent
{

      protected $table = "promociones";
      // Don't forget to fill this array
      protected $fillable = ['nombre', 'descripcion', 'inicio', 'fin', 'path'];

      public function client()
      {
            return $this->belongsTo('Client', 'client_id', 'id');
      }

}
