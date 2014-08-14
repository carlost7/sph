<?php

/*
 * Modelo de BD para guardar los datos de negocios 
 */
class Negocio extends \Eloquent
{

      protected $table = 'negocios';
      
      protected $fillable = ['nombre', 'direccion', 'telefono', 'descripcion', 'moneda', 'rango_min', 'rango_max'];

      /*
       * Un negocio tiene mas informacion
       */
      public function mas_info()
      {
            return $this->hasOne('MasInfoNegocio');
      }
      /*
       * Un negocio tiene un horario
       */
      public function horario(){
            return $this->hasOne('HorarioNegocio');
      }

      /*
       * Un negocio le pertenece a un cliente
       */
      public function client()
      {
            return $this->belongsTo('Cliente', 'cliente_id', 'id');
      }

      /*
       * Un negocio puede tener datos espeialoes
       */
      public function especial()
      {
            return $this->hasOne('Negocio_especial', 'negocio_id', 'id');
      }

      
      /*
       * Un negocio gneera un pago
       */
      public function pago()
      {
            return $this->morphOne('Pago', 'pagable');
      }

      
      /*
       * Un negocio puede genear un aviso para marketing
       */
      public function aviso()
      {
            return $this->morphOne('Aviso_cliente', 'avisable');
      }

      
      /*
       * Un negocio tiene diferentes promociones
       */
      public function promociones()
      {
            return $this->hasMany('Promocion');
      }

      /*
       * Un negocio tiene un estado
       */

      public function estado()
      {
            return $this->belongsTO('Estado');
      }

      /*
       * Un negocio tiene una zona
       */

      public function zona()
      {
            return $this->belongsTO('Zona');
      }

      /*
       * Un negocio tiene una categoria
       */

      public function categoria()
      {
            return $this->belongsTO('Categoria');
      }

      /*
       * Un negocio tiene una subcategoria
       */

      public function subcategoria()
      {
            return $this->belongsTO('Subcategoria');
      }

      /*
       * tiene diferentes imagenes
       */

      public function imagenes()
      {
            return $this->morphMany('Imagen', 'imageable');
      }

}
