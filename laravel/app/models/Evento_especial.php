<?php

/*
 * Modelo de DB en donde se guarda la informacion especial de eventos
 */
class Evento_especial extends \Eloquent
{

      protected $table = 'eventos_especiales';
      
      protected $fillable = ['mapa','email','web'];

      /*
       * Esta informacion le pertenece a un evento
       */
      public function evento()
      {
            return $this->belongsTo('Evento', 'evento_id', 'id');
      }

}
