<?php

/*
 * Modelo de bd para guardar los datos adicionales de negocio
 */
class MasInfoNegocio extends \Eloquent
{

      protected $table = 'mas_info_negocios';
      
      protected $fillable = ['domicilio', 'llevar', 'moneda', 'rango_min', 'rango_max','efectivo', 'tc', 'td', 'familiar', 'alcohol'];

      /*
       * los datos extra le pertenecen a un negocio
       */
      public function negocio()
      {
            return $this->belongsTo('Negocio');
      }

}
