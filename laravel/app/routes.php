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

Route::get('/', array(
    'uses' => 'ContenidoController@index',
    'as'   => 'home'
));

/*
 * -----------------------------------
 * Mostrar Negocios
 * -----------------------------------
 */
Route::get('negocios', array(
    'uses' => 'NegociosController@index',
    'as'   => 'negocios.index'
));

Route::get('negocios/{id}/{nombre?}', array(
    'uses' => 'NegociosController@show',
    'as'   => 'negocios.show'
));

/*
 * -----------------------------------
 * Mostrar Eventos
 * -----------------------------------
 */
Route::get('cartelera', array(
    'uses' => 'EventosController@index',
    'as'   => 'eventos.index'
));

Route::get('cartelera/{id}/{nombre?}', array(
    'uses' => 'EventosController@show',
    'as'   => 'eventos.show'
));

/*
 * *******************************
 *            Users Session
 * *******************************
 */
Route::get('login', array(
    'uses' => 'SessionController@create',
    'as'   => 'session.create'
));
Route::get('login/{provider}', array(
    'uses' => 'SessionController@authorise',
    'as'   => 'session.authorise'
));

Route::post('login', array(
    'uses' => 'SessionController@store',
    'as'   => 'session.store'
));
Route::get('logout', array(
    'uses' => 'SessionController@destroy',
    'as'   => 'session.destroy'
));

//Reminder Controller
Route::controller('password', 'RemindersController');

/**
 * Social Authentication
 *
 * Authenticate via a social provider
 */
Route::get('auth/register', array(
    'uses' => 'AuthenticateController@register',
    'as'   => 'authenticate.register'
));

Route::get('auth/{provider}', array(
    'uses' => 'AuthenticateController@authorise',
    'as'   => 'authenticate.authorise'
));

Route::get('auth/{provider}/callback', array(
    'uses' => 'AuthenticateController@callback',
    'as'   => 'authenticate.callback'
));

Route::post('auth', array(
    'uses' => 'AuthenticateController@store',
    'as'   => 'authenticate.store'
));


/*
 * ****************************
 *      Registro de usuarios
 * ****************************
 */
Route::get('register_index', array(
    'uses' => 'RegisterController@index',
    'as'   => 'register.index'
));

Route::get('registrar_cliente', array(
    'uses' => 'RegisterController@register_client',
    'as'   => 'register.client'
));
Route::post('registar_cliente', array(
    'uses' => 'RegisterController@store_client',
    'as'   => 'register.store_client'
));

Route::get('activar_cliente/{token?}/{id?}', array(
    'uses' => 'RegisterController@activate_client',
    'as'   => 'register.activate_client'
));


/*
 * **************************
 * Registro de usuario
 * **************************
 */
Route::get('registrar_usuario', array(
    'uses' => 'RegisterController@register_user',
    'as'   => 'register.user'
));
Route::post('registrar-usuario', array(
    'uses' => 'RegisterController@store_user',
    'as'   => 'register.store_user'
));



/*
 * **************************************
 * recibir_notificacion_prueba
 * **************************************
 */

Route::any('pagos/recibir_notificacion_prueba', array('uses' => 'PagosController@recibir_notificacion_prueba', 'as' => 'recibir_notificacion_prueba'));
Route::any('pagos/recibir_notificacion', array('uses' => 'PagosController@recibir_notificacion', 'as' => 'recibir_notificacion'));
Route::get('pagos/obtener_pago_prueba', array('uses' => 'PagosController@obtener_pago_prueba', 'as' => 'obtener_pago_prueba'));


/*
 * *****************************
 * Subcategoria y zona
 * *****************************
 */

Route::get('obtener_subcategoria/{categoria_id}', array('as'   => 'obtener_subcategoria',
    'uses' => 'SubcategoriasController@getSubcategorias'));

Route::get('obtener_zona/{estado_id}', array('as'   => 'obtener_zona',
    'uses' => 'ZonasController@getZonas'));

Route::get('catalogo_zonas', array('as'   => 'catalogo_zonas',
    'uses' => 'ContenidoController@getCatalogoZonas'));

Route::get('catalogo_categorias', array('as'   => 'catalogo_categorias',
    'uses' => 'ContenidoController@getCatalogoCategorias'));

/*
 * ***********************
 * Solo para usuarios autenticados
 * ***********************
 */
Route::group(array('before' => 'auth'), function() {


      /*
       * ***********************
       *     clientes
       * ***********************
       */

      Route::group(array('prefix' => 'publicar', 'before' => 'is_cliente'), function() {

            Route::resource('cliente', 'ClientesController');

            /*
             * *************************
             *    Negocios de Cliente
             * *************************
             */

            Route::get('clientes_negocios_activar/{id}', array('as'   => 'publicar.clientes_negocios_activar.get',
                'uses' => 'clientesNegociosController@activar')
            );


            Route::resource('clientes_negocios', 'clientesNegociosController');

            Route::get('clientes/negocios/imagenes/{negocio_id}', array('as'   => 'publicar.clientes_negocio_imagenes.index',
                'uses' => 'ClientesNegociosImagenesController@index'));
            Route::post('clientes/negocios/imagenes/{negocio_id}', array('as'   => 'publicar.clientes_negocio_imagenes.store',
                'uses' => 'ClientesNegociosImagenesController@store'));
            Route::delete('clientes/negocios/imagenes/{negocio_id}/{id}', array('as'   => 'publicar.clientes_negocio_imagenes.destroy',
                'uses' => 'ClientesNegociosImagenesController@destroy'));



            /*
             * *************************
             *    Eventos de Cliente
             * *************************
             */

            Route::resource('clientes_eventos', 'clientesEventosController');

            Route::get('clientes/eventos/imagenes/{evento_id}', array('as'   => 'publicar.clientes_evento_imagenes.index',
                'uses' => 'ClientesEventosImagenesController@index'));
            Route::post('clientes/eventos/imagenes/{evento_id}', array('as'   => 'publicar.clientes_evento_imagenes.store',
                'uses' => 'ClientesEventosImagenesController@store'));
            Route::delete('clientes/eventos/imagenes/{evento_id}/{id}', array('as'   => 'publicar.clientes_evento_imagenes.destroy',
                'uses' => 'ClientesEventosImagenesController@destroy'));


            /*
             * *************************
             *    Promociones de Cliente
             * *************************
             */

            Route::resource('clientes_promociones', 'clientesPromocionesController');



            /*
             * *************************
             *    Promociones de Cliente
             * *************************
             */
            Route::get('clientes_pagos_codigo/{id}', array('as'   => 'clientes_pagos_codigo.get',
                'uses' => 'clientesPagosController@usar_codigo')
            );

            Route::post('clientes_pagos_codigo/{id}', array('as'   => 'clientes_pagos_codigo.post',
                'uses' => 'clientesPagosController@guardar_codigo')
            );

            Route::get('clientes_pagos_avisar_marketing/{id}', array('as'   => 'clientes_pagos_avisar_marketing.get',
                'uses' => 'clientesPagosController@avisar_marketing')
            );
            Route::resource('clientes_pagos', 'clientesPagosController', array('names' => array('index'   => 'clientes_pagos.index',
                    'create'  => 'clientes_pagos.create',
                    'store'   => 'clientes_pagos.store',
                    'show'    => 'clientes_pagos.show',
                    'edit'    => 'clientes_pagos.edit',
                    'update'  => 'clientes_pagos.update',
                    'destroy' => 'clientes_pagos.destroy')));

            /*
             * **********************************
             * Opcion para mostrar, contestar y eliminar comentarios
             * **********************************
             */
            Route::resource('clientes_comentarios', 'ClientesComentariosController', array('names' => array('index'   => 'clientes_comentarios.index',
                    'create'  => 'clientes_comentarios.create',
                    'store'   => 'clientes_comentarios.store',
                    'show'    => 'clientes_comentarios.show',
                    'edit'    => 'clientes_comentarios.edit',
                    'update'  => 'clientes_comentarios.update',
                    'destroy' => 'clientes_comentarios.destroy')));
      });

      /*
       * ***********************
       *     marketing
       * ***********************
       */
      Route::group(array('before' => 'is_marketing'), function() {
            Route::get('marketings', array(
                'uses' => 'MarketingController@index',
                'as'   => 'marketing.index'
            ));

            Route::get('marketings_edit', array(
                'uses' => 'MarketingController@edit',
                'as'   => 'marketing.edit'
            ));

            Route::post('marketings_update', array(
                'uses' => 'MarketingController@update',
                'as'   => 'marketing.update'
            ));

            Route::post('marketings_delete', array(
                'uses' => 'MarketingController@destroy',
                'as'   => 'marketing.destroy'
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
       * ***********************
       *     Administrador
       * ***********************
       */
      Route::group(array('before' => 'is_admin'), function() {
            Route::get('administradores', array(
                'uses' => 'AdministradoresController@index',
                'as'   => 'administradores.index'
            ));

            Route::get('administradores_edit', array(
                'uses' => 'AdministradoresController@edit',
                'as'   => 'administradores.edit'
            ));

            Route::post('administradores_update', array(
                'uses' => 'AdministradoresController@update',
                'as'   => 'administradores.update'
            ));

            /*
             * **********************************
             * Catalogo
             * **********************************
             */

            Route::resource('administrador_catalogo', 'AdminCatalogoController');

            /*
             * *************************
             * Registro de marketing
             * *************************
             */

            Route::get('register_marketing', array(
                'uses' => 'RegisterController@register_marketing',
                'as'   => 'register.marketing'
            ));
            Route::post('register_marketing', array(
                'uses' => 'RegisterController@store_marketing',
                'as'   => 'register.store_marketing'
            ));

            /*
             * *************************
             * Registro de Administradores
             * *************************
             */

            Route::get('registrar-administrador', array(
                'uses' => 'RegisterController@register_admin',
                'as'   => 'register.admin'
            ));
            Route::post('registrar_administrador', array(
                'uses' => 'RegisterController@store_admin',
                'as'   => 'register.store_admin'
            ));


            /* Generación de codigos */
            Route::get('create_codes', function() {
                  for ($i = 0; $i < 10; $i++) {
                        $numero = rand(1000, 9999) . "-" . rand(1000, 9999) . "-" . rand(1000, 9999);
                        Codigo::create(array('numero' => $numero));
                        echo $numero . "<br>";
                  }
            });
      });

      /*
       * ********************************
       * Miembro
       * ********************************
       */
      Route::group(array('before' => 'is_miembro'), function() {
            Route::get('miembro/rank/{tipo}/{id}', array(
                'uses' => 'MiembrosController@add_rank',
                'as'   => 'miembro.add_rank'
            ));

            Route::post('miembro/rank/{tipo}/{id}', array(
                'uses' => 'MiembrosController@add_rank',
                'as'   => 'miembro.add_rank'
            ));

            Route::get('miembro/rank/{tipo}/{id}', array(
                'uses' => 'MiembrosController@add_rank',
                'as'   => 'miembro.add_rank'
            ));

            Route::resource('miembros', 'MiembrosController');
      });


      /*
       * ********************************
       * Pagos del usuario
       * ********************************
       */
      Route::get('pagar_contenido', array('as'   => 'pagar_contenido.get',
          'uses' => 'PagosController@generar_link_pago')
      );


      Route::resource('comentarios', 'ComentariosController');
});

