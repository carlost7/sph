<?php

/*
 * Modelo de Bd que guardará los datos de eventos que el cliente suba
 */

class Evento extends \Eloquent
{

      protected $table = 'eventos';
      protected $fillable = ['nombre', 'fecha_inicio', 'fecha_fin', 'hora_inicio', 'hora_fin', 'lugar', 'direccion', 'descripcion', 'telefono'];

      /*
       * Un evento tiene mas informacion
       */

      public function masInfo()
      {
            return $this->hasOne('MasInfoEvento');
      }

      /*
       * Un evento le pertenece a un cliente
       */

      public function cliente()
      {
            return $this->belongsTo('Cliente');
      }

      /*
       * Un evento tiene campos especiales
       */

      public function especial()
      {
            return $this->hasOne('Evento_especial', 'evento_id', 'id');
      }

      /*
       * Un evento genera un pago
       */

      public function pago()
      {
            return $this->morphOne('Pago', 'pagable');
      }

      /*
       * Un evento genera un aviso
       */

      public function aviso()
      {
            return $this->morphOne('Aviso_cliente', 'avisable');
      }

      /*
       * Un evento tiene un estado
       */

      public function estado()
      {
            return $this->belongsTO('Estado');
      }

      /*
       * Un evento tiene una zona
       */

      public function zona()
      {
            return $this->belongsTO('Zona');
      }

      /*
       * Un evento tiene una categoria
       */

      public function categoria()
      {
            return $this->belongsTO('Categoria');
      }

      /*
       * Un evento tiene una subcategoria
       */

      public function subcategoria()
      {
            return $this->belongsTO('Subcategoria');
      }

      /*
       * tiene diferentes imagenes
       */

      public function imagen()
      {
            return $this->morphOne('Imagen', 'imageable');
      }

      
            /*
       * tiene diferentes ranks
       */

      public function ranks()
      {
            return $this->hasMany('RankEvento');
      }

      public function miembros()
      {
            return $this->hasManyThrough('RankEvento', 'Miembro');
      }
}
