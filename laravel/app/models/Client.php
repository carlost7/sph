<?php

class Client extends \Eloquent
{

        // Don't forget to fill this array
        protected $fillable = ['name', 'telephone'];

        public function user()
        {
                return $this->morphOne('User','userable');
        }

}
