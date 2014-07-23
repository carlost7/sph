<?php

class Promocion_especial extends \Eloquent
{

      protected $table = "promociones_especiales";
      // Don't forget to fill this array
      protected $fillable = ['imagenes'];

      public function promocion(){            
            return $this->belongsTo('Promocion', 'promocion_id','id');
      }

}
