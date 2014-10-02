<?php

/*
 * Modelo de BD para guardar los datos de un cliente
 */

class RankNegocio extends \Eloquent
{

      protected $table = 'negocios_ranks';

      public function negocio(){
            return $this->belongsTo('Negocio');
      }
      
      public function miembro()
      {
            return $this->belongsTo('Miembro');
      }

}
