<?php

class Codigo extends \Eloquent
{

      protected $table = 'codigos';
      // Don't forget to fill this array
      protected $fillable = ['numero', 'usado'];

      public function client()
      {
            return $this->belongsTo('Cliente', 'cliente_id', 'id');
      }

}
