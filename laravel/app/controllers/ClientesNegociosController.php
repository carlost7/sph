<?php

use Illuminate\Events\Dispatcher;

class clientesNegociosController extends \BaseController
{

      public function __construct()
      {
            parent::__construct();
            $this->events = new Dispatcher;
            View::share('section', 'Negocio');
      }

      /**
       * Display a listing of negocios
       *
       * @return Response
       */
      public function index()
      {
            $negocios = Auth::user()->userable->negocios;
            return View::make('clientes.negocios.index', compact('negocios'));
      }

      /**
       * Show the form for creating a new negocio
       *
       * @return Response
       */
      public function create()
      {
            $categorias = Categoria::all();
            $estados = Estado::all();
            return View::make('clientes.negocios.create', compact('categorias', 'estados'));
      }

      /**
       * Store a newly created negocio in storage.
       *
       * @return Response
       */
      public function store()
      {

            /*
             * Buscamos los estados, zonas, categorias, y subcategorias
             */

            $estado = Estado::find(Input::get('estado_id'));
            $zona = (Input::get('zona_id')) ? Zona::find(Input::get('zona_id')) : null;
            $categoria = Categoria::find(Input::get('categoria_id'));
            $subcategoria = (Input::get('subcategoria_id')) ? Subcategoria::find(Input::get('subcategoria_id')) : null;

            if (!count($estado) || !count($categoria))
            {
                  Session::flash('error', "Debe elegir un Estado y una Categoría");
                  Redirect::back()->withInput()->withErrors();
            }

            $negocio = new Negocio;
            $masInfo = new MasInfoNegocio;
            $horario = new HorarioNegocio;

            $negocio->publicar = false;
            $negocio->estado()->associate($estado);
            if (isset($zona))
            {
                  $negocio->zona()->associate($zona);
            }
            $negocio->categoria()->associate($categoria);
            if (isset($subcategoria))
            {
                  $negocio->subcategoria()->associate($subcategoria);
            }
            $negocio->cliente()->associate(Auth::user()->userable);

            if (!$negocio->validate())
            {
                  return Redirect::back()->withInput()->withErrors($negocio->errors());
            }
            if (!$masInfo->validate())
            {
                  return Redirect::back()->withInput()->withErrors($masInfo->errors());
            }
            if (!$horario->validate())
            {
                  return Redirect::back()->withInput()->withErrors($horario->errors());
            }

            //Guardamos el negocio
            if ($negocio->save())
            {

                  $negocio->masInfo()->save($masInfo);
                  $negocio->horario()->save($horario);

                  $this->events->fire('negocio.created',array($negocio));
                  
                  Session::flash('message', "Negocio creado con exito");
                  return Redirect::route('publicar.clientes_negocio_imagenes.index',array($negocio->id));
            }
            else
            {
                  Session::flash('error', 'No se pudo guardar el negocio, intentelo de nuevo');
                  return Redirect::back()->withInput();
            }
      }

      /**
       * Display the specified negocio.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $negocio = Negocio::find($id);
            if (Auth::user()->userable->id !== $negocio->cliente->id)
            {
                  Session::flash('error', 'El negocio no pertenece al usuario actual');
                  return Redirect::back();
            }

            return View::make('clientes.negocios.show', compact("negocio"));
      }

      /**
       * Show the form for editing the specified negocio.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $negocio = Negocio::find($id);
            if (Auth::user()->userable->id !== $negocio->cliente->id)
            {
                  Session::flash('error', 'El negocio no pertenece al usuario actual');
                  return Redirect::back();
            }


            $categorias = Categoria::all();
            $estados = Estado::all();

            return View::make('clientes.negocios.edit', compact("estados", "categorias", "negocio"));
      }

      /**
       * Update the specified negocio in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $negocio = Negocio::find($id);
            if (Auth::user()->userable->id !== $negocio->cliente->id)
            {
                  Session::flash('error', 'El negocio no pertenece al usuario actual');
                  return Redirect::back();

            }
            
            
            $estado = Estado::find(Input::get('estado_id'));
            $zona = (Input::get('zona_id')) ? Zona::find(Input::get('zona_id')) : null;
            $categoria = Categoria::find(Input::get('categoria_id'));
            $subcategoria = (Input::get('subcategoria_id')) ? Subcategoria::find(5000) : null;
            
            if (!count($estado) || !count($categoria))
            {
                  Session::flash('error', "Debe elegir un Estado y una Categoría");
                  Redirect::back()->withInput();
            }
            
            $negocio->estado()->associate($estado);
            if (isset($zona))
            {
                  $negocio->zona()->associate($zona);
            }
            $negocio->categoria()->associate($categoria);
            if (isset($subcategoria))
            {
                  $negocio->subcategoria()->associate($subcategoria);
            }
            $negocio->cliente()->associate(Auth::user()->userable);

            
            if (!$negocio->validate())
            {
                  return Redirect::back()->withInput()->withErrors($negocio->errors());
            }            
            
            if (!$negocio->masInfo->validate())
            {
                  return Redirect::back()->withInput()->withErrors($negocio->masInfo->errors());
            }
            
            if(Input::get('lun')){
                  $negocio->horario->lun_ini = null;
                  $negocio->horario->lun_fin = null;
            }
            if(Input::get('mar')){
                  $negocio->horario->mar_ini = null;
                  $negocio->horario->mar_fin = null;
            }            
            if(Input::get('mie')){
                  $negocio->horario->mie_ini = null;
                  $negocio->horario->mie_fin = null;
            }
            if(Input::get('jue')){
                  $negocio->horario->jue_ini = null;
                  $negocio->horario->jue_fin = null;
            }            
            if(Input::get('vie')){
                  $negocio->horario->vie_ini = null;
                  $negocio->horario->vie_fin = null;
            }            
            if(Input::get('sab')){
                  $negocio->horario->sab_ini = null;
                  $negocio->horario->sab_fin = null;
            }
            if(Input::get('dom')){
                  $negocio->horario->dom_ini = null;
                  $negocio->horario->dom_fin = null;
            }            
            
            if (!$negocio->horario->validate())
            {
                  return Redirect::back()->withInput()->withErrors($negocio->horario->errors());
            }

            
            //Guardamos el negocio
            if ($negocio->updateUniques())
            {

                  $negocio->masInfo->updateUniques();
                  $negocio->horario->updateUniques();

                  Session::flash('message', "Negocio editado con exito");
                  return Redirect::route('publicar.clientes_negocios.index');
            }
            else
            {
                  Session::flash('error', 'No se pudo editar el negocio, intentelo de nuevo');
                  return Redirect::back()->withInput();
            }
      }

      /**
       * Remove the specified negocio from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            $negocio = Negocio::find($id);
            if (Auth::user()->userable->id !== $negocio->cliente->id)
            {
                  Session::flash('error', 'El negocio no pertenece al usuario actual');
                  return Redirect::back();
            }

            if ($negocio->delete())
            {
                  Session::flash('message', 'Negocio eliminado');
            }
            else
            {
                  Session::flash('error', 'No se pudo eliminar el negocio');
            }

            return Redirect::route('clientes_negocios.index');
      }

      /*
       * Funcion que le permite al usuario activar su negocio nuevamente
       * 
       */

      public function activar($id)
      {
            $negocio = $this->negocio->find($id);
            if (Auth::user()->userable->id !== $negocio->cliente->id)
            {
                  Session::flash('error', 'El negocio no pertenece al usuario actual');
                  return Redirect::back();
            }

            $negocio = $this->negocio->find($id);
            if ($negocio->cliente->id == Auth::user()->userable->id)
            {
                  if ($this->negocio->activar($id))
                  {
                        Session::flash('message', 'Activación correcta');
                        return Redirect::route('clientes_negocios.index');
                  }
                  else
                  {
                        Session::flash('error', 'El negocio no pertenece al usuario');
                  }
            }
            else
            {
                  Session::flash('error', 'El negocio no pertenece al usuario');
            }
            return Redirect::back();
      }

}
