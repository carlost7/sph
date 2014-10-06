<?php

/*
 * Modelo de BD para guardar los datos de un cliente
 */

class RankEvento extends \Eloquent
{

      protected $table = 'eventos_ranks';

      public function evento(){
            return $this->belongsTo('Evento');
      }
      
      public function miembro()
      {
            return $this->belongsTo('Miembro');
      }

}
