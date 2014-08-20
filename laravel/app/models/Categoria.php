<?php

/*
 * Modelo de DB para agregar las categorias de la guia
 */
class Categoria extends \Eloquent
{

      protected $table = 'categorias';
      protected $fillable = ['categoria'];

      /*
       * Una categoria tiene muchos negocios
       */
      public function negocios()
      {
            $this->hasMany('Negocio');
      }

      /*
       * Una categoria tiene muchos eventos
       */
      public function eventos()
      {
            $this->hasMnay('Evento');
      }

}
