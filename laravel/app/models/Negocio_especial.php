<?php

class Negocio_especial extends \Eloquent
{

      protected $table = 'negocios_especiales';
      // Don't forget to fill this array
      protected $fillable = ['horario'];

      public function negocio()
      {
            return $this->belongsTo('Negocio', 'negocio_id', 'id');
      }

}
