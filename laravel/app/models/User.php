<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class User extends Ardent implements UserInterface, RemindableInterface {

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
      protected $fillable = array('email', 'oauth_token', 'oauth_token_secret', 'uid', 'password', 'password_confirmation');

      /*
       * Create guarded for our data
       */
      protected $guarded                    = array('id', 'password');
      // Auto hash passwords
      public static $passwordAttributes     = array('password');
      public $autoHashPasswordAttributes    = true;
      public static $rules                  = array(
          'email'                 => 'required|email|unique:users,email',
          'password'              => 'required|alpha_dash|min:6|confirmed',
          'password_confirmation' => 'required',
      );
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;
      public static $relationsData          = array(
          'userable' => array(self::MORPH_TO)
      );

}
