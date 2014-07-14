<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{

        use UserTrait,
            RemindableTrait;

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'users';

        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        protected $hidden = array('password', 'remember_token');

        /*
         * Create fillable for our data
         */
        protected $fillable = array('nombre', 'email', 'telefono', 'role_id', 'is_activo');

        /*
         * Create guarded for our data
         */
        protected $guarded = array('id', 'password');

        /*
         * Determine the type of user we have
         */

        public function userable()
        {
                return $this->morphTo();
        }

}
