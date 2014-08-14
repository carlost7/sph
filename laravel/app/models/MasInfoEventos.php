<?php

class MasInfoEventos extends \Eloquent
{

      protected $table = 'mas_info_eventos';
      protected $fillable = ['moneda', 'costo', 'min_edad', 'max_edad', 'alcohol', 'tc', 'td', 'efectivo', 'otra'];

      /*
       * Esta informacion pertenece a un evento;
       */
      public function evento()
      {
            return $this->belongsTo('Evento');
      }

}
