<?php

use LaravelBook\Ardent\Ardent;

/*
 * Modelo de Bd que guardará los datos de eventos que el cliente suba
 */

class Evento extends Ardent
{

      public static $rules = array(
            'nombre' => 'required',
            'fecha_inicio' => array('required', 'after:Carbon\Carbon::now()'),
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'hora_inicio' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
            'hora_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
            'lugar' => 'required',
            'direccion' => 'required',
            'descripcion' => 'required|min:30|max:500',
            'telefono' => 'required',
            'mapa' => '',
            'email' => 'email',
            'web' => 'url'
      );
      protected $table = 'eventos';
      protected $fillable = ['nombre', 'fecha_inicio', 'fecha_fin', 'hora_inicio', 'hora_fin', 'lugar', 'direccion', 'descripcion', 'telefono', 'mapa', 'email', 'web'];
      public $autoHydrateEntityFromInput = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes = true;
      public static $relationsData = array(
            'masInfo' => array(self::HAS_ONE, 'MasInfoEvento'),
            'ranks' => array(self::HAS_MANY, 'Ranks'),
            'cliente' => array(self::BELONGS_TO, 'Cliente'),
            'estado' => array(self::BELONGS_TO, 'Estado'),
            'zona' => array(self::BELONGS_TO, 'Zona'),
            'categoria' => array(self::BELONGS_TO, 'Categoria'),
            'subcategoria' => array(self::BELONGS_TO, 'Subcategoria'),
            'pago' => array(self::MORPH_ONE, 'Pago', 'name' => 'pagable'),
            'aviso' => array(self::MORPH_ONE, 'Aviso_cliente', 'avisable'),
            'imagenes' => array(self::MORPH_MANY, 'Imagen', 'name' => 'imageable'),
            'comentarios' => array(self::MORPH_MANY, 'Comentario', 'name' => 'comentable'),
            'topics' => array(self::MORPH_MANY, 'Comentario', 'name' => 'topic'),
      );

      public function miembros()
      {
            return $this->hasManyThrough('RankEvento', 'Miembro');
      }

}
