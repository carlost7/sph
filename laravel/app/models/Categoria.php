<?php

class Categoria extends \Eloquent
{

      protected $table = 'categorias';
      protected $fillable = ['categorias'];

      protected function negocios()
      {
            $this->belongsTo('Negocio');
      }

      protected function eventos()
      {
            $this->belongsTo('Evento');
      }

}
