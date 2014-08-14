<?php

/*
 * Modelo de BD que guardara los datos de subcategorias
 */

class Subcategoria extends \Eloquent
{

      protected $fillable = ['subcategoria'];

      /*
       * Una subcategoria pertenece a una categoria
       */

      public function categoria()
      {
            return $this->belongsTo('Categoria');
      }
      
      public function negocios(){
            return $this->hasMany('Negocio');
      }
      
      public function eventos(){
            return $this->hasMany('Evento');
      }

}
