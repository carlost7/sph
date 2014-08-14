<?php

class Aviso_cliente extends \Eloquent
{

      protected $table = 'avisos_clientes';

      public function cliente()
      {
            return $this->belongsTo('Clientee', 'cliente_id', 'id');
      }

      public function avisable()
      {
            return $this->morphTo();
      }

}
