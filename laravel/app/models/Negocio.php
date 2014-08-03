<?php

class Negocio extends \Eloquent
{

      protected $table = 'negocios';
      
      // Don't forget to fill this array
      protected $fillable = ['nombre', 'direccion', 'telefono', 'descripcion','publicar'];

      public function client()
      {
            return $this->belongsTo('Client', 'client_id', 'id');
      }
      
      public function especial(){
            return $this->hasOne('Negocio_especial','negocio_id','id');
      }
      
      public function pago(){            
            return $this->morphOne('Pago', 'pagable');
      }
      
      public function aviso(){            
            return $this->morphOne('Aviso_cliente', 'avisable');
      }

}
