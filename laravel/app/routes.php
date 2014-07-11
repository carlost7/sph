<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::get('/', function() {
      return View::make('hello');
});

// route to show the login form
Route::get('login', array('as'=>'login.get','uses' => 'HomeController@showLogin'));

// route to process the form
Route::post('login', array('as'=>'login.post','uses' => 'HomeController@doLogin'));

// route to logout user
Route::post('logout',array('as'=>'logout','uses'=>'HomeController@doLogout'));

//Reminder Controller
Route::controller('password', 'RemindersController');

Route::get('user/register',array('as'=>'user.register','uses'=>'UserController@register'));
Route::post('user/register',array('as'=>'user.register','uses'=>'UserController@store'));