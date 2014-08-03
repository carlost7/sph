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
      
      public function especial(){
            return $this->hasOne('Promocion_especial','promocion_id','id');
      }
      
      public function pago(){            
            return $this->morphOne('Pago', 'pagable');
      }
      
      public function aviso(){            
            return $this->morphOne('Aviso_cliente', 'avisable');
      }

}
