<?php

/*
 * Modelo de BD para guardar los datos de negocios 
 */

use LaravelBook\Ardent\Ardent;

class Negocio extends Ardent {

      public static $rules                  = array(
          'nombre'      => 'required',
          'direccion'   => 'required',
          'telefono'    => 'required',
          'descripcion' => 'required|min:30|max:500',
          'email'       => 'required|email',
          'webpage'     => 'required|url',
              /* 'lat'         => 'required',
                'long'        => 'required', */
      );
      protected $table                      = 'negocios';
      protected $fillable                   = ['nombre', 'direccion', 'telefono', 'descripcion', 'email', 'webpage', 'lat', 'long'];
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;
      public static $relationsData          = array(
          'masInfo'      => array(self::HAS_ONE, 'MasInfoNegocio'),
          'horario'      => array(self::HAS_ONE, 'HorarioNegocio'),
          'promociones'  => array(self::HAS_MANY, 'Promociones'),
          'ranks'        => array(self::HAS_MANY, 'Ranks'),
          'estado'       => array(self::BELONGS_TO, 'Estado'),
          'zona'         => array(self::BELONGS_TO, 'Zona'),
          'categoria'    => array(self::BELONGS_TO, 'Categoria'),
          'subcategoria' => array(self::BELONGS_TO, 'Subcategoria'),
          'cliente'      => array(self::BELONGS_TO, 'Cliente'),
          'pago'         => array(self::MORPH_ONE, 'Pago', 'name' => 'pagable'),
          'aviso'        => array(self::MORPH_ONE, 'Aviso_cliente', 'avisable'),
          'comentarios'  => array(self::MORPH_MANY, 'Comentario', 'name' => 'comentable'),
          'topics'       => array(self::MORPH_MANY, 'Comentario', 'name' => 'topic'),
          'imagenes'     => array(self::MORPH_MANY, 'Imagen', 'name' => 'imageable'),
      );

      public function miembros()
      {
            return $this->hasManyThrough('RankNegocio', 'Miembro');
      }

      public function afterCreate()
      {
            if (!count(Event::fire('negocio.created', array($this))))
            {
                  return false;
            }
      }

}
