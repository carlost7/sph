<?php

use Illuminate\Events\Dispatcher;

class clientesPromocionesController extends \BaseController
{
      public function __construct()
      {
            parent::__construct();
            $this->events = new Dispatcher;
            View::share('section', 'Promocion');
      }

      /**
       * Display a listing of promociones
       *
       * @return Response
       */
      public function index()
      {
            $promociones = Auth::user()->userable->promociones;

            return View::make('clientes.promociones.index', compact('promociones'));
      }

      /**
       * Show the form for creating a new negocio
       *
       * @return Response
       */
      public function create()
      {
            $negocios = Auth::user()->userable->negocios;

            return View::make('clientes.promociones.create', compact("negocios"));
      }

      /**
       * Store a newly created negocio in storage.
       *
       * @return Response
       */
      public function store()
      {
            $negocio = Negocio::find(Input::get('negocio_id'));
            if (Auth::user()->userable->id !== $negocio->cliente->id)
            {
                  Session::flash('error', 'La promoción no pertenece al usuario actual');
                  return Redirect::back();
            }
            $promocion = new Promocion;
            $promocion->publicar = false;
            $promocion->cliente()->associate(Auth::user()->userable);
            $promocion->negocio()->associate($negocio);

            if ($promocion->save())
            {
                  $this->events->fire('promocion.created', array($promocion));

                  Session::flash('message', "Promoción creada con exito");
                  return Redirect::route('publicar.clientes_imagenes.index', array(get_class($promocion), $promocion->id));
            }
            else
            {
                  Session::flash('error', 'No se pudo guardar la promocion, intentelo de nuevo');
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
            $promocion = $this->promocion->find($id);

            if (Auth::user()->userable->id !== $promocion->negocio->cliente->id)
            {
                  Session::flash('error', 'La promoción no pertenece al usuario actual');
                  return Redirect::back();
            }

            return View::make('clientes.promociones.show', compact('promocion'));
      }

      /**
       * Show the form for editing the specified negocio.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $negocios = Auth::user()->userable->negocios;
            $promocion = Promocion::find($id);

            if (Auth::user()->userable->id !== $promocion->negocio->cliente->id)
            {
                  Session::flash('error', 'La promoción no pertenece al usuario actual');
                  return Redirect::back();
            }

            $inicio = new Carbon($promocion->publicacion_inicio);
            if (Carbon::now()->gte($inicio))
            {
                  $editar_publicacion = false;
            }
            else
            {
                  if ($promocion->pago->pagado)
                  {
                        $editar_publicacion = false;
                  }
                  else
                  {
                        $editar_publicacion = true;
                  }
            }

            return View::make('clientes.promociones.edit')->with(
                            array('promocion' => $promocion,
                                  'negocios' => $negocios,
                                  'editar_publicacion' => $editar_publicacion)
            );
      }

      /**
       * Update the specified negocio in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $promocion = Promocion::find($id);

            if (Auth::user()->userable->id !== $promocion->negocio->cliente->id)
            {
                  Session::flash('error', 'La promoción no pertenece al usuario actual');
                  return Redirect::back();
            }
            
            if ($promocion->updateUniques())
            {
                  Session::flash('message', "Promoción editada con exito");
                  return Redirect::route('publicar.clientes_promociones.index', array(get_class($promocion), $promocion->id));
            }
            else
            {
                  Session::flash('error', 'No se pudo guardar la promocion, intentelo de nuevo');
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
            $promocion = Promocion::find($id);

            if (Auth::user()->userable->id !== $promocion->negocio->cliente->id)
            {
                  Session::flash('error', 'La promoción no pertenece al usuario actual');
                  return Redirect::back();
            }

            if ($promocion->delete($id))
            {
                  Session::flash('message', 'Promocion eliminada');
            }
            else
            {
                  Session::flash('error', 'No se pudo eliminar la promoción');
            }
            return Redirect::route('clientes_promociones.index');
      }

}
