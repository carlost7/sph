<?php

/*
 * Modelo de Bd que guardará los datos de eventos que el cliente suba
 */

use LaravelBook\Ardent\Ardent;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Evento extends Ardent implements StaplerableInterface {

      use EloquentTrait;

      public function __construct(array $attributes = array())
      {
            $this->hasAttachedFile('imagen', [
                'styles' => [
                    'medium' => '250x250',
                    'thumb'  => '100x100'
                ]
            ]);

            parent::__construct($attributes);
      }

      public static $rules                  = array(
          'nombre'             => 'required',
          'lugar'              => 'required',
          'direccion'          => 'required',
          'descripcion'        => 'required|min:30|max:500',
          'telefono'           => 'required',
          'mapa'               => '',
          'email'              => 'email',
          'webpage'            => 'url',
          'tiempo_publicacion' => 'required|numeric'
      );
      protected $table                      = 'eventos';
      protected $fillable                   = ['nombre', 'fecha_inicio', 'fecha_fin',
          'hora_inicio', 'hora_fin', 'lugar',
          'direccion', 'descripcion', 'telefono',
          'lat', 'long', 'email', 'webpage',
          'tiempo_publicacion', 'imagen'];
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;
      public static $relationsData          = array(
          'masInfo'      => array(self::HAS_ONE, 'MasInfoEvento'),
          'ranks'        => array(self::HAS_MANY, 'Ranks'),
          'cliente'      => array(self::BELONGS_TO, 'Cliente'),
          'estado'       => array(self::BELONGS_TO, 'Estado'),
          'zona'         => array(self::BELONGS_TO, 'Zona'),
          'categoria'    => array(self::BELONGS_TO, 'Categoria'),
          'subcategoria' => array(self::BELONGS_TO, 'Subcategoria'),
          'pago'         => array(self::MORPH_ONE, 'Pago', 'name' => 'pagable'),
          'aviso'        => array(self::MORPH_ONE, 'Aviso_cliente', 'avisable', 'name' => 'avisable'),
          'imagenes'     => array(self::HAS_MANY, 'EventoImagen'),
          'comentarios'  => array(self::MORPH_MANY, 'Comentario', 'name' => 'comentable'),
          'topics'       => array(self::MORPH_MANY, 'Comentario', 'name' => 'topic'),
      );

      public function miembros()
      {
            return $this->hasManyThrough('RankEvento', 'Miembro');
      }

      /*public function afterCreate()
      {
            if (!count(Event::fire('evento.created', array($this))))
            {
                  return false;
            }
      }*/
      
      public function afterUpdate()
      {
            if (!count(Event::fire('evento.updated', array($this))))
            {
                  return false;
            }
      }

      public function setFechaInicioAttribute($date)
      {
            if ($date)
            {
                  $this->attributes['fecha_inicio'] = date('Y-m-d', (strtotime($date)));
            }
            else
            {
                  $this->attributes['fecha_inicio'] = '';
            }
      }

      public function setFechaFinAttribute($date)
      {
            if ($date)
            {
                  $this->attributes['fecha_fin'] = date('Y-m-d', (strtotime($date)));
            }
            else
            {
                  $this->attributes['fecha_fin'] = '';
            }
      }

      public function setPublicacionInicioAttribute($date)
      {
            if ($date)
            {
                  $this->attributes['publicacion_inicio'] = date('Y-m-d', (strtotime($date)));
            }
            else
            {
                  $this->attributes['publicacion_inicio'] = '';
            }
      }

      public function setPublicacionFinAttribute($date)
      {
            if ($date)
            {
                  $this->attributes['publicacion_fin'] = date('Y-m-d', (strtotime($date)));
            }
            else
            {
                  $this->attributes['publicacion_fin'] = '';
            }
      }

      public function getFechaInicioAttribute()
      {
            $tmpdate = $this->attributes['fecha_inicio'];
            if ($tmpdate == null || $tmpdate == "0000-00-00 00:00:00")
            {
                  return "";
            }
            else
            {
                  return new \Carbon\Carbon($tmpdate);
            }
      }

      public function getFechaFinAttribute()
      {
            $tmpdate = $this->attributes['fecha_fin'];
            if ($tmpdate == null || $tmpdate == "0000-00-00 00:00:00")
            {
                  return "";
            }
            else
            {
                  return new \Carbon\Carbon($tmpdate);
            }
      }

      public function getPublicacionInicioAttribute()
      {
            $tmpdate = $this->attributes['publicacion_inicio'];
            if ($tmpdate == null || $tmpdate == "0000-00-00 00:00:00")
            {
                  return "";
            }
            else
            {
                  return new \Carbon\Carbon($tmpdate);
            }
      }

      public function getPublicacionFinAttribute()
      {
            $tmpdate = $this->attributes['publicacion_fin'];
            if ($tmpdate == null || $tmpdate == "0000-00-00 00:00:00")
            {
                  return "";
            }
            else
            {
                  return new \Carbon\Carbon($tmpdate);
            }
      }
      
      public function getHoraInicioAttribute()
      {
            $tmpdate = $this->attributes['hora_inicio'];
            if ($tmpdate == null || $tmpdate == "00:00:00")
            {
                  return "";
            }
            else
            {
                  return new \Carbon\Carbon($tmpdate);
            }
      }
      
      public function getHoraFinAttribute()
      {
            $tmpdate = $this->attributes['hora_fin'];
            if ($tmpdate == null || $tmpdate == "00:00:00")
            {
                  return "";
            }
            else
            {
                  return new \Carbon\Carbon($tmpdate);
            }
      }

}
