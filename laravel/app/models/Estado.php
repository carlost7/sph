<?php

/*
 * Modelo de BD que guardar los datos de estados 
 */

class Estado extends \Eloquent
{

      protected $table = 'estados';
      protected $fillable = ['estado'];

      /*
       * Un estado tiene muchos negocios
       */

      public function negocios()
      {
            return $this->hasMany('Negocio');
      }

      /*
       * Un estado tiene mucohs eventos
       */

      public function eventos()
      {
            return $this->hasMany('Evento');
      }

      public function zonas()
      {
            return $this->hasMany('Zona');
      }

}
