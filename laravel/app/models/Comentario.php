<?php

use LaravelBook\Ardent\Ardent;

class Comentario extends Ardent {

      protected $table                      = 'comentarios';
      protected $fillable                   = ['comentario', 'topic_id', 'topic_type'];
      public static $rules                  = array(
          'comentario' => 'required|min:2|max:5000'
      );
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;
      public static $relationsData          = array(
          'usuario'     => array(self::BELONGS_TO, 'User'),
          'comentable'  => array(self::MORPH_TO),
          'topic'       => array(self::MORPH_TO),
          'comentarios' => array(self::MORPH_MANY, 'Comentario', 'name' => 'comentable'),
      );

}
