<?php

use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use LaravelBook\Ardent\Ardent;

class Miembro extends Ardent implements StaplerableInterface
{
      use EloquentTrait;

      public function __construct(array $attributes = array())
      {
            $this->hasAttachedFile('avatar', [
                'styles' => [
                    'medium' => '250x250',
                    'thumb'  => '100x100'
                ]
            ]);

            parent::__construct($attributes);
      }
      
      public static $rules                  = array(
          'username' => 'required|unique:miembros,username',
      );
      protected $table                      = 'miembros';
      protected $fillable                   = ['username','avatar'];
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;
      
      public static $relationsData          = array(
          'ranknegocios'  => array(self::HAS_MANY, 'RankNegocio'),
          'rankeventos'  => array(self::HAS_MANY, 'RankEvento'),
          'user'         => array(self::MORPH_ONE, 'User', 'name' => 'userable'),
      );
      
      public function negocios()
      {
            return $this->hasManyThrough('RankNegocio','Negocio');
      }
      
}
