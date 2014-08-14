<?php

/*
 * Modelo de BD donde se guardaran los datos de las zonas del estado
 */

class Zona extends \Eloquent
{

      protected $fillable = ['zona'];

      /*
       * Una zona pertenece a un estado
       */

      public function estado()
      {
            return $this->belongsTo('Estado');
      }
      /*
       * Una zona tiene muchos negocios
       */
      public function negocio()
      {
            return $this->hasMany('Negocio');
      }

      /*
       * Una zona tiene muchos eventos
       */
      public function evento()
      {
            return $this->hasMany('Evento');
      }

}
