<?php

class Negocio extends \Eloquent
{

      protected $table = 'negocios';
      
      // Don't forget to fill this array
      protected $fillable = ['nombre', 'direccion', 'telefono', 'descripcion'];

      public function client()
      {
            return $this->belongsTo('Client', 'client_id', 'id');
      }

}
