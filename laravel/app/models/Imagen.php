<?php

/*
 * Modelo de BD para guardar los datos de las imagenes
 */

class Imagen extends \Eloquent
{
      
      protected $table = 'imagenes';

      protected $fillable = ['path', 'nombre', 'alt'];

      /*
       * le pertenece a diferente tablas
       */
      public function imageable()
      {
            return $this->morphTo();
      }
      
      /*
       * Una imagen le corresponde a un usuario;
       */
      public function cliente(){
            return $this->hasOne('Cliente');
      }

}
