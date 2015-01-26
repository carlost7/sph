<?php

/*
 * Modelo de BD para guardar los datos de negocios 
 */

use LaravelBook\Ardent\Ardent;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Promocion extends Ardent implements StaplerableInterface {

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
          'codigo'             => 'required',
          'descripcion'        => 'required|min:30|max:500',
          'vigencia_inicio'    => array('required', 'after:Carbon\Carbon::now()'),
          'vigencia_fin'       => 'required|date|after:vigencia_inicio',
          'negocio_id'         => 'required|exists:negocios,id',
          'tiempo_publicacion' => 'required|numeric'
      );
      protected $table                      = "promociones";
      protected $fillable                   = ['nombre', 'codigo', 'descripcion', 'vigencia_inicio', 'vigencia_fin', 'publicar', 'imagen', 'tiempo_publicacion'];
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;
      public static $relationsData          = array(
          'pago'    => array(self::MORPH_ONE, 'Pago', 'name' => 'pagable'),
          'aviso'   => array(self::MORPH_ONE, 'Aviso_cliente', "name"=>'avisable'),
          'negocio' => array(self::BELONGS_TO, 'Negocio'),
      );

      public function afterCreate()
      {
            if (!count(Event::fire('promocion.created', array($this))))
            {
                  return false;
            }
      }

      public function setVigenciaInicioAttribute($date)
      {
            if ($date)
            {
                  $this->attributes['vigencia_inicio'] = date('Y-m-d', (strtotime($date)));
            }
            else
            {
                  $this->attributes['vigencia_inicio'] = '';
            }
      }

      public function getVigenciaInicioAttribute()
      {
            $tmpdate = $this->attributes['vigencia_inicio'];
            if ($tmpdate == null || $tmpdate == "0000-00-00 00:00:00")
            {
                  return "";
            }
            else
            {
                  return new \Carbon\Carbon($tmpdate);
            }
      }

      public function setVigenciaFinAttribute($date)
      {
            if ($date)
            {
                  $this->attributes['vigencia_fin'] = date('Y-m-d', (strtotime($date)));
            }
            else
            {
                  $this->attributes['vigencia_fin'] = '';
            }
      }

      public function getVigenciaFinAttribute()
      {
            $tmpdate = $this->attributes['vigencia_fin'];
            if ($tmpdate == null || $tmpdate == "0000-00-00 00:00:00")
            {
                  return "";
            }
            else
            {
                  return new \Carbon\Carbon($tmpdate);
            }
      }

}
