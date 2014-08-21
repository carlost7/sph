<?php

/*
 * Modelo de BD para guardar los datos de un cliente
 */

class Cliente extends \Eloquent
{

      protected $table = 'clientes';
      protected $fillable = ['nombre', 'apellido', 'empresa', 'telefono', 'ext', 'celular', 'token'];

      /*
       * Un cliente tambien es un usuario
       */

      public function user()
      {
            return $this->morphOne('User', 'userable');
      }

      /*
       * Un cliente tiene muchos negocios
       */

      public function negocios()
      {
            return $this->hasMany('Negocio', 'cliente_id', 'id');
      }

      /*
       * Un cliente tiene muchos eventos
       */

      public function eventos()
      {
            return $this->hasMany('Evento', 'cliente_id', 'id');
      }

      /*
       * Un cliente tiene muchas promociones a traves de un negocio
       */

      public function promociones()
      {
            return $this->hasManyThrough('Negocio', 'Promocion');
      }

      /*
       * Un cliente genera muchos pagos
       */

      public function pagos()
      {
            return $this->hasMany('Pago', 'cliente_id', 'id');
      }

      /*
       * Un cliente le pertenece a un usuario de marketing
       */

      public function marketing()
      {
            return $this->belongsTo('Marketing', 'marketing_id', 'id');
      }

      /*
       * Un cliente tiene muchos registros de bitacora
       */

      public function bitacoras()
      {
            return $this->hasMany('Bitacora_cliente', 'cliente_id', 'id');
      }

      /*
       * Un cliente tiene muchos avisos
       */

      public function avisos()
      {
            return $this->hasMany('Aviso_cliente', 'cliente_id', 'id');
      }

      /*
       * Un cliente tiene muchas imagenes
       */

      public function imagenes()
      {
            return $this->hasMany('Imagen', 'cliente_id', 'id');
      }

      /*
       * *******************************
       * Accessor
       * *******************************
       */

      public function getTotalImagesAttribute()
      {
            return $this->hasMany('Imagen')->count();
      }

}
