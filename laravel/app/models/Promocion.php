<?php

use LaravelBook\Ardent\Ardent;

class Promocion extends Ardent
{

      public static $rules = array(
            'nombre' => 'required',
            'codigo' => 'required|alpha_dash',
            'descripcion' => 'required|min:30|max:500',
            'vigencia_inicio' => array('required', 'after:Carbon\Carbon::now()'),
            'vigencia_fin' => 'required|date|after:vigencia_inicio',
            'negocio' => 'required|exists:negocios,id',
      );
      protected $table = "promociones";
      protected $fillable = ['nombre', 'codigo', 'descripcion', 'vigencia_inicio', 'vigencia_fin', 'publicar'];

      public $autoHydrateEntityFromInput = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes = true;
      public static $relationsData = array(
            'pago' => array(self::MORPH_ONE, 'Pago', 'name' => 'pagable'),
            'aviso' => array(self::MORPH_ONE, 'Aviso_cliente', 'avisable'),
            'imagenes' => array(self::MORPH_MANY, 'Imagen', 'name' => 'imageable'),
            'negocio' => array(self::BELONGS_TO, 'Negocio'),
      );
      
}
