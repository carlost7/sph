<?php

class Evento_especial extends \Eloquent
{

      protected $table = 'eventos_especiales';
      // Don't forget to fill this array
      protected $fillable = ['imagenes'];

      public function evento()
      {
            return $this->belongsTo('Evento', 'evento_id', 'id');
      }

}
