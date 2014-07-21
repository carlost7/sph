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

Route::get('/', function()
{
        return View::make('hello');
});




/*
 * *******************************
 *            Users Session
 * *******************************
 */
Route::get('login', array(
    'uses' => 'SessionController@create',
    'as' => 'session.create'
));
Route::post('login', array(
    'uses' => 'SessionController@store',
    'as' => 'session.store'
));
Route::get('logout', array(
    'uses' => 'SessionController@destroy',
    'as' => 'session.destroy'
));

//Reminder Controller
Route::controller('password', 'RemindersController');




/*
 * ****************************
 *      Registry of users
 * ****************************
 */
Route::get('register_index', array(
    'uses' => 'RegisterController@index',
    'as' => 'register.index'
));

Route::get('register_client', array(
    'uses' => 'RegisterController@register_client',
    'as' => 'register.client'
));
Route::post('register_client', array(
    'uses' => 'RegisterController@store_client',
    'as' => 'register.store_client'
));

Route::get('activate_client/{token?}/{id?}', array(
    'uses' => 'RegisterController@activate_client',
    'as' => 'register.activate_client'
));

Route::get('register_user', array(
    'uses' => 'RegisterController@register_user',
    'as' => 'register.user'
));
Route::post('register_user', array(
    'uses' => 'RegisterController@store_user',
    'as' => 'register.store_user'
));

Route::get('register_marketing', array(
    'uses' => 'RegisterController@register_marketing',
    'as' => 'register.marketing'
));
Route::post('register_marketing', array(
    'uses' => 'RegisterController@store_marketing',
    'as' => 'register.store_marketing'
));


/*
 * ***********************
 *     clients
 * ***********************
 */

Route::get('/clients',array(
    'uses' => 'ClientsController@index',
    'as' => 'clients.index'
));

Route::get('/clients_edit',array(
    'uses' => 'ClientsController@edit',
    'as' => 'clients.edit'
));

Route::post('/clients_update',array(
    'uses' => 'ClientsController@update',
    'as' => 'clients.update'
));

Route::post('/clients_delete',array(
    'uses' => 'ClientsController@destroy',
    'as' => 'clients.destroy'
));


/*
 * *************************
 *    Negocios de Cliente
 * *************************
 */

Route::resource('clientes_negocios','ClientsNegociosController');

/*
 * *************************
 *    Eventos de Cliente
 * *************************
 */

Route::resource('clientes_eventos','ClientsEventosController');

/*
 * *************************
 *    Promociones de Cliente
 * *************************
 */

Route::resource('clientes_promociones','ClientsPromocionesController');

/*
 * *************************
 *    Promociones de Cliente
 * *************************
 */
Route::resource('clientes_pagos', 'ClientsPagosController');