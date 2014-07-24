<?php

class Marketing extends \Eloquent
{

      protected $table = 'marketings';
      
      protected $fillable = ['nombre'];

      public function user()
      {
            return $this->morphOne('User', 'userable');
      }
      
}
