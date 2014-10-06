<?php

class Comentario extends \Eloquent {

      protected $table = 'comentarios';
      
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}