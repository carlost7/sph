<?php

class Miembro extends \Eloquent
{

      protected $table = 'miembros';
      protected $fillable = ['username'];

      public function user()
      {
            return $this->morphOne('User', 'userable');
      }
      
}
