<?php

use LaravelBook\Ardent\Ardent;

class Categoria extends Ardent
{

      protected $table = 'categorias';
      protected $fillable = ['categoria'];

      public static $rules                  = array(
          'categoria' => 'required',
      );
      public static $relationsData          = array(
          'negocios' => array(self::HAS_MANY, 'Negocio'),
          'eventos' => array(self::HAS_MANY, 'Evento'),
          'subcategorias' => array(self::HAS_MANY, 'Subcategoria'),          
      );
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;

}
