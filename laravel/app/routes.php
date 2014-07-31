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
 *      Registro de usuarios
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


/*
 * **************************
 * Registro de usuario
 * **************************
 */
Route::get('register_user', array(
    'uses' => 'RegisterController@register_user',
    'as' => 'register.user'
));
Route::post('register_user', array(
    'uses' => 'RegisterController@store_user',
    'as' => 'register.store_user'
));

/*
 * *************************
 * Registro de marketing
 * *************************
 */

Route::get('register_marketing', array(
    'uses' => 'RegisterController@register_marketing',
    'as' => 'register.marketing'
));
Route::post('register_marketing', array(
    'uses' => 'RegisterController@store_marketing',
    'as' => 'register.store_marketing'
));


/* Generación de codigos */

Route::get('create_codes', function()
{
      for ($i = 0; $i < 10; $i++)
      {
            $numero = rand(1000, 9999) . "-" . rand(1000, 9999) . "-" . rand(1000, 9999);
            Codigo::create(array('numero' => $numero));
            echo $numero . "<br>";
      }
});


/*
 * ***********************
 * Solo para usuarios autenticados
 * ***********************
 */
Route::group(array('before' => 'auth'), function()
{


      /*
       * ***********************
       *     clients
       * ***********************
       */

      Route::group(array('before' => 'is_client'), function()
      {

            Route::get('clients', array(
                'uses' => 'ClientsController@index',
                'as' => 'clients.index'
            ));

            Route::get('clients_edit', array(
                'uses' => 'ClientsController@edit',
                'as' => 'clients.edit'
            ));

            Route::post('clients_update', array(
                'uses' => 'ClientsController@update',
                'as' => 'clients.update'
            ));

            Route::post('clients_delete', array(
                'uses' => 'ClientsController@destroy',
                'as' => 'clients.destroy'
            ));

            Route::get('client_avisar_marketing', array(
                'uses' => 'ClientsController@avisar_marketing',
                'as' => 'client_avisar'
            ));


            /*
             * *************************
             *    Negocios de Cliente
             * *************************
             */

            Route::resource('clientes_negocios', 'ClientsNegociosController');

            Route::get('clientes_negocios_activar/{id}', array('as' => 'clientes_negocios_activar.get',
                'uses' => 'ClientsNegociosController@activar')
            );

            /*
             * *************************
             *    Eventos de Cliente
             * *************************
             */

            Route::resource('clientes_eventos', 'ClientsEventosController');

            Route::get('clientes_eventos_activar/{id}', array('as' => 'clientes_eventos_activar.post',
                'uses' => 'ClientsEventosController@activar')
            );

            /*
             * *************************
             *    Promociones de Cliente
             * *************************
             */

            Route::resource('clientes_promociones', 'ClientsPromocionesController');

            Route::get('clientes_promociones_activar/{id}', array('as' => 'clientes_promociones_activar.get',
                'uses' => 'ClientsPromocionesController@activar')
            );


            /*
             * *************************
             *    Promociones de Cliente
             * *************************
             */
            Route::resource('clientes_pagos', 'ClientsPagosController');


            Route::get('clientes_pagos_codigo/{id}', array('as' => 'clientes_pagos_codigo.get',
                'uses' => 'ClientsPagosController@usar_codigo')
            );

            Route::post('clientes_pagos_codigo/{id}', array('as' => 'clientes_pagos_codigo.post',
                'uses' => 'ClientsPagosController@guardar_codigo')
            );

            Route::post('clientes_negocios_activar/{id}', array('as' => 'clientes_negocios_activar.post',
                'uses' => 'ClientsNegociosController@activar')
            );
      });

      /*
       * ***********************
       *     marketing
       * ***********************
       */
      Route::group(array('before' => 'is_marketing'), function()
      {
            Route::get('/marketings', array(
                'uses' => 'MarketingController@index',
                'as' => 'marketing.index'
            ));

            Route::get('/marketings_edit', array(
                'uses' => 'MarketingController@edit',
                'as' => 'marketing.edit'
            ));

            Route::post('/marketings_update', array(
                'uses' => 'MarketingController@update',
                'as' => 'marketing.update'
            ));

            Route::post('/marketings_delete', array(
                'uses' => 'MarketingController@destroy',
                'as' => 'marketing.destroy'
            ));
            
            /*
             * *************************
             *    Negocios de Cliente
             * *************************
             */

            Route::resource('marketing_avisos', 'MarketingAvisosController');
            Route::post('marketing_avisos_publicar/{id}', array('as' => 'marketing_avisos_negocios.update', 'uses' => 'MarketingAvisosController@update'));
            
      });
});

