<?php

class Client extends \Eloquent
{

      protected $table = 'clients';
      // Don't forget to fill this array
      protected $fillable = ['name', 'telephone', 'is_active', 'token','tiene_aviso'];

      public function user()
      {
            return $this->morphOne('User', 'userable');
      }

      public function negocios()
      {
            return $this->hasMany('Negocio', 'client_id', 'id');
      }

      public function eventos()
      {
            return $this->hasMany('Evento', 'client_id', 'id');
      }

      public function promociones()
      {
            return $this->hasMany('Promocion', 'client_id', 'id');
      }
      
      public function pagos()
      {
            return $this->hasMany('Pago', 'client_id', 'id');
      }
      
      public function marketing(){
            return $this->belongsTo('Marketing','marketing_id','id');
      }

}
