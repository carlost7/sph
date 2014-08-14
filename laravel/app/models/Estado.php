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
            $this->hasMany('Negocio');
      }

      /*
       * Un estado tiene mucohs eventos
       */
      public function eventos()
      {
            $this->hasMany('Evento');
      }

}
