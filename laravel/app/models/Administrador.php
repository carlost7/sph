<?php

class Administrador extends \Eloquent {

	protected $table = 'administradores';
      
      
	// Don't forget to fill this array
	protected $fillable = ['nombre'];
      
      /*
       * Un administrador tambien es un usuario
       */
      public function user()
      {
            return $this->morphOne('User', 'userable');
      }

}