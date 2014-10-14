<?php

/*
 * Modelo de bd para guardar los datos adicionales de negocio
 */
class MasInfoNegocio extends \Eloquent
{

      protected $table = 'mas_info_negocios';
      
      protected $fillable = ["efectivo","tc","td","familiar","estacionamiento","valet_parking","wifi","mascotas"];

      /*
       * los datos extra le pertenecen a un negocio
       */
      public function negocio()
      {
            return $this->belongsTo('Negocio');
      }

}



