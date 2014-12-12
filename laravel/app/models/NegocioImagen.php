<?php

use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class NegocioImagen extends \Eloquent implements StaplerableInterface {

      use EloquentTrait;

      public static $rules = [
          'imagen' => 'image|required|max:20000'
      ];

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

      protected $table    = 'negocios_imagenes';
      protected $fillable = ['imagen'];

      public function negocio()
      {
            return $this->belongsTo('Negocio', 'negocio_id', 'id');
      }

}
