<?php

class Comentario extends \Eloquent
{

      protected $table = 'comentarios';
      protected $fillable = ['comentario'];

      public function comentable()
      {
            return $this->morphTo();
      }

      public function usuario()
      {
            return $this->belongsTo('User');
      }

      public function comentarios()
      {

            return $this->morphMany('Comentario', 'comentable');
      }

      public function topic()
      {
            return $this->morphTo();
      }

}
