<?php

/*
 * Modelo de BD para guardar los datos de las imagenes
 */

class Imagen extends \Eloquent
{

      protected $fillable = ['path', 'nombre', 'alt'];

      /*
       * le pertenece a diferente tablas
       */
      public function imageable()
      {
            return $this->morphTo();
      }

}
