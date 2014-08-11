<?php

class Pago extends \Eloquent {

	// Don't forget to fill this array
	protected $fillable = ["nombre","descripcion","monto","pagado","metodo","status"];
      
      public function client()
      {
            return $this->belongsTo('Client', 'client_id', 'id');
      }
      
      public function pagable(){
            return $this->morphTo();
      }

}