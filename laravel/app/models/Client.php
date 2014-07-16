<?php

class Client extends \Eloquent
{

        // Don't forget to fill this array
        protected $fillable = ['name', 'telephone','is_active','token'];

        public function user()
        {
                return $this->morphOne('User','userable');
        }
        
        public function negocios(){
              return $this->hasMany('Negocio','client_id','id');
        }

}
