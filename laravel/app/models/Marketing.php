<?php

class Marketing extends \Eloquent
{

      protected $table = 'marketings';
      
      protected $fillable = ['name'];

      public function user()
      {
            return $this->morphOne('User', 'userable');
      }
      
      public function clientes(){
            return $this->hasMany('Client','marketing_id','id');
      }
      
}
