<?php

use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class NegocioImagen extends \Eloquent implements StaplerableInterface {

      use EloquentTrait;

      public static $rules = [
          'imagen' => 'image|max:20000',  
          'alt' => 'max:20'
      ];

      public function __construct(array $attributes = array())
      {
            $this->hasAttachedFile('imagen', [
                'styles' => [
                    'large' => '800x800',
                    
                ]
            ]);

            parent::__construct($attributes);
      }

      protected $table    = 'negocios_imagenes';
      protected $fillable = ['imagen','alt'];

      public function negocio()
      {
            return $this->belongsTo('Negocio', 'negocio_id', 'id');
      }

}
