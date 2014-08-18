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
 * **************************************
 * recibir_notificacion_prueba
 * **************************************
 */

Route::any('pagos/recibir_notificacion_prueba', array('uses' => 'PagosController@recibir_notificacion_prueba', 'as' => 'recibir_notificacion_prueba'));
Route::any('pagos/recibir_notificacion', array('uses' => 'PagosController@recibir_notificacion', 'as' => 'recibir_notificacion'));

/*
 * ***********************
 * Solo para usuarios autenticados
 * ***********************
 */
Route::group(array('before' => 'auth'), function()
{


      /*
       * ***********************
       *     clientes
       * ***********************
       */

      Route::group(array('before' => 'is_client'), function()
      {

            Route::get('clientes', array(
                'uses' => 'clientesController@index',
                'as' => 'clientes.index'
            ));

            Route::get('clients_edit', array(
                'uses' => 'clientesController@edit',
                'as' => 'clientes.edit'
            ));

            Route::post('clients_update', array(
                'uses' => 'clientesController@update',
                'as' => 'clientes.update'
            ));

            Route::post('clients_delete', array(
                'uses' => 'clientesController@destroy',
                'as' => 'clientes.destroy'
            ));



            /*
             * *************************
             *    Negocios de Cliente
             * *************************
             */

            Route::resource('clientes_negocios', 'clientesNegociosController');

            Route::get('clientes_negocios_activar/{id}', array('as' => 'clientes_negocios_activar.get',
                'uses' => 'clientesNegociosController@activar')
            );



            /*
             * *************************
             *    Eventos de Cliente
             * *************************
             */

            Route::resource('clientes_eventos', 'clientesEventosController');

            Route::get('clientes_eventos_activar/{id}', array('as' => 'clientes_eventos_activar.post',
                'uses' => 'clientesEventosController@activar')
            );

            /*
             * *************************
             *    Promociones de Cliente
             * *************************
             */

            Route::resource('clientes_promociones', 'clientesPromocionesController');

            Route::get('clientes_promociones_activar/{id}', array('as' => 'clientes_promociones_activar.get',
                'uses' => 'clientesPromocionesController@activar')
            );


            /*
             * *************************
             *    Promociones de Cliente
             * *************************
             */
            Route::resource('clientes_pagos', 'clientesPagosController');


            Route::get('clientes_pagos_codigo/{id}', array('as' => 'clientes_pagos_codigo.get',
                'uses' => 'clientesPagosController@usar_codigo')
            );

            Route::post('clientes_pagos_codigo/{id}', array('as' => 'clientes_pagos_codigo.post',
                'uses' => 'clientesPagosController@guardar_codigo')
            );

            Route::get('clientes_pagos_avisar_marketing/{id}', array('as' => 'clientes_pagos_avisar_marketing.get',
                'uses' => 'clientesPagosController@avisar_marketing')
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
             *    Publicaciones de cliente
             * *************************
             */

            Route::resource('marketing_avisos', 'MarketingAvisosController');
            Route::post('marketing_avisos_publicar/{id}', array('as' => 'marketing_avisos_publicar.update', 'uses' => 'MarketingAvisosController@publicar'));

            /*
             * ********************************
             *    Clientes y Agenda
             * ********************************
             */
            Route::resource('marketing_clientes', 'MarketingClientesController');
      });

      /*
       * ********************************
       * Pagos del usuario
       * ********************************
       */
      Route::get('pagar_contenido', array('as' => 'pagar_contenido.get',
          'uses' => 'PagosController@generar_link_pago')
      );
});

