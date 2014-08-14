<?php

class Cliente extends \Eloquent
{

      protected $table = 'clientes';
      // Don't forget to fill this array
      protected $fillable = ['nombre', 'apellido', 'empresa', 'telefoono', 'ext', 'celular', 'token'];

      public function user()
      {
            return $this->morphOne('User', 'userable');
      }

      public function negocios()
      {
            return $this->hasMany('Negocio', 'cliente_id', 'id');
      }

      public function eventos()
      {
            return $this->hasMany('Evento', 'cliente_id', 'id');
      }

      public function pagos()
      {
            return $this->hasMany('Pago', 'cliente_id', 'id');
      }

      public function marketing()
      {
            return $this->belongsTo('Marketing', 'marketing_id', 'id');
      }

      public function bitacoras()
      {
            return $this->hasMany('Bitacora_cliente', 'cliente_id', 'id');
      }

      public function avisos()
      {
            return $this->hasMany('Aviso_cliente', 'cliente_id', 'id');
      }

}
