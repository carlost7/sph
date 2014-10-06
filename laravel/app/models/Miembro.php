<?php

class Miembro extends \Eloquent
{

      protected $table = 'miembros';
      protected $fillable = ['username'];

      public function user()
      {
            return $this->morphOne('User', 'userable');
      }

      public function imagen()
      {
            return $this->morphOne('Imagen', 'imageable');
      }

      public function ranknegocios()
      {
            return $this->hasMany('RankNegocio');
      }
      
      public function rankeventos()
      {
            return $this->hasMany('RankEvento');
      }

      public function negocios()
      {
            return $this->hasManyThrough('RankNegocio','Negocio');
      }

}
