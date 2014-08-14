<?php

/*
 * Modelo de BD para guardar datos especiales del negocio
 */
class Negocio_especial extends \Eloquent
{

      protected $table = 'negocios_especiales';
      
      protected $fillable = ['email','webpage','mapa'];

      /*
       * Los datos especiales le pertenecen a un negocio
       */
      public function negocio()
      {
            return $this->belongsTo('Negocio');
      }

}
