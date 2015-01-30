<?php

use Illuminate\Events\Dispatcher;

class clientesEventosController extends \BaseController {

      public function __construct()
      {
            parent::__construct();
            $this->events = new Dispatcher;
            View::share('section', 'Evento');
      }

      /**
       * Display a listing of eventos
       *
       * @return Response
       */
      public function index()
      {
            $eventos = Auth::user()->userable->eventos;
            return View::make('clientes.eventos.index', compact("eventos"));
      }

      /**
       * Show the form for creating a new evento
       *
       * @return Response
       */
      public function create()
      {
            $categorias = Categoria::all();
            $estados    = Estado::all();

            return View::make('clientes.eventos.create', compact("categorias", "estados"));
      }

      /**
       * Store a newly created evento in storage.
       *
       * @return Response
       */
      public function store()
      {
            /*
             * Buscamos los estados, zonas, categorias, y subcategorias
             */

            $estado       = Estado::find(Input::get('estado_id'));
            $zona         = (Input::get('zona_id')) ? Zona::find(Input::get('zona_id')) : null;
            $categoria    = Categoria::find(Input::get('categoria_id'));
            $subcategoria = (Input::get('subcategoria_id')) ? Subcategoria::find(Input::get('subcategoria_id')) : null;

            if (!count($estado) || !count($categoria))
            {
                  Session::flash('error', "Debe elegir un Estado y una Categoría");
                  Redirect::back()->withInput();
            }

            $evento  = new Evento;
            $masInfo = new MasInfoEvento;

            $evento->publicar           = false;
            $evento->publicacion_inicio = Input::get('publicacion_inicio');
            $evento->publicacion_fin    = Input::get('publicacion_fin');

            $evento->estado()->associate($estado);

            if (isset($zona))
            {
                  $evento->zona()->associate($zona);
            }
            $evento->categoria()->associate($categoria);
            if (isset($subcategoria))
            {
                  $evento->subcategoria()->associate($subcategoria);
            }
            $evento->cliente()->associate(Auth::user()->userable);

            if (!$evento->validate())
            {
                  return Redirect::back()->withInput()->withErrors($evento->errors());
            }
            if (!$masInfo->validate())
            {
                  return Redirect::back()->withInput()->withErrors($masInfo->errors());
            }

            //Guardamos el evento
            if ($evento->save())
            {

                  $evento->masInfo()->save($masInfo);

                  Session::flash('message', "Evento creado con exito");
                  return Redirect::route('publicar.clientes_evento_imagenes.index', array($evento->id));
            }
            else
            {
                  Session::flash('error', 'No se pudo guardar el evento, intentelo de nuevo');
                  return Redirect::back()->withInput();
            }
      }

      public function show($id)
      {
            $evento = Evento::find($id);
            if (Auth::user()->userable->id !== $evento->cliente->id)
            {
                  Session::flash('error', 'El evento no pertenece al usuario actual');
                  return Redirect::back();
            }

            return View::make('clientes.eventos.show', compact("evento"));
      }

      /**
       * Show the form for editing the specified evento.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $evento = Evento::find($id);
            if (Auth::user()->userable->id !== $evento->cliente->id)
            {
                  Session::flash('error', 'El evento no pertenece al usuario actual');
                  return Redirect::back();
            }

            if (\Carbon\Carbon::now()->gte($evento->publicacion_inicio))
            {
                  $editar_publicacion = false;
            }
            else
            {
                  if (count($evento->pago))
                  {
                        if ($evento->pago->pagado)
                        {
                              $editar_publicacion = false;
                        }
                        else
                        {
                              $editar_publicacion = true;
                        }
                  }
                  else
                  {
                        $editar_publicacion = true;
                  }
            }

            $categorias = Categoria::all();
            $estados    = Estado::all();

            return View::make('clientes.eventos.edit', compact("estados", "categorias", "evento", "editar_publicacion"));
      }

      /**
       * Update the specified evento in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $evento = Evento::find($id);
            if (Auth::user()->userable->id !== $evento->cliente->id)
            {
                  Session::flash('error', 'El evento no pertenece al usuario actual');
                  return Redirect::back();
            }

            $estado       = Estado::find(Input::get('estado_id'));
            $zona         = (Input::get('zona_id')) ? Zona::find(Input::get('zona_id')) : null;
            $categoria    = Categoria::find(Input::get('categoria_id'));
            $subcategoria = (Input::get('subcategoria_id')) ? Subcategoria::find(5000) : null;
            if (!count($estado) || !count($categoria))
            {
                  Session::flash('error', "Debe elegir un Estado y una Categoría");
                  Redirect::back()->withInput();
            }

            $evento->estado()->associate($estado);
            if (isset($zona))
            {
                  $evento->zona()->associate($zona);
            }
            $evento->categoria()->associate($categoria);
            if (isset($subcategoria))
            {
                  $evento->subcategoria()->associate($subcategoria);
            }
            $evento->cliente()->associate(Auth::user()->userable);

            if (!$evento->validate())
            {
                  return Redirect::back()->withInput()->withErrors($evento->errors());
            }
            if (!$evento->masInfo->validate())
            {
                  return Redirect::back()->withInput()->withErrors($evento->masInfo->errors());
            }

            //Guardamos el evento
            if ($evento->updateUniques())
            {

                  $evento->masInfo->updateUniques();
                  $this->events->fire('evento.modified', array($evento));
                  Session::flash('message', "Evento editado con exito");
                  return Redirect::route('publicar.clientes_eventos.index');
            }
            else
            {
                  Session::flash('error', 'No se pudo editar el evento, intentelo de nuevo');
                  return Redirect::back()->withInput();
            }
      }

      /**
       * Remove the specified evento from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            $evento = Evento::find($id);
            if (Auth::user()->userable->id !== $evento->cliente->id)
            {
                  Session::flash('error', 'El evento no pertenece al usuario actual');
                  return Redirect::back();
            }

            if(count($evento->pago)){
                  $evento->pago->delete();
            }
            

            if ($evento->delete())
            {
                  Session::flash('message', 'Evento eliminado');
            }
            else
            {
                  Session::flash('error', 'No se pudo eliminar el evento');
            }

            return Redirect::route('publicar.clientes_eventos.index');
      }

}
