<?php

class Promocion extends \Eloquent
{

      protected $table = "promociones";
      // Don't forget to fill this array
      protected $fillable = ['nombre', 'codigo', 'descripcion', 'vigencia_inicio', 'vigencia_fin', 'publicar'];

      public function client()
      {
            return $this->belongsTo('Cliente', 'cliente_id', 'id');
      }

      public function pago()
      {
            return $this->morphOne('Pago', 'pagable');
      }

      public function aviso()
      {
            return $this->morphOne('Aviso_cliente', 'avisable');
      }

      public function negocio()
      {
            return $this->belongsTo('Negocio');
      }

      public function imagen()
      {
            return $this->morphOne('Imagen', 'imageable');
      }

}
