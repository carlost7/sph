<?php

use Sph\Storage\Negocio\NegocioRepository as Negocio;

class ClientsNegociosController extends \BaseController
{

      protected $negocio;

      public function __construct(Negocio $negocio)
      {
            $this->negocio = $negocio;
      }

      /**
       * Display a listing of negocios
       *
       * @return Response
       */
      public function index()
      {
            $negocios = Auth::user()->userable->negocios;
            return View::make('clients.negocios.index')->with("negocios", $negocios);
      }

      /**
       * Show the form for creating a new negocio
       *
       * @return Response
       */
      public function create()
      {
            return View::make('clients.negocios.create');
      }

      /**
       * Store a newly created negocio in storage.
       *
       * @return Response
       */
      public function store()
      {
            $validatorNegocio = new Sph\Services\Validators\Negocio(Input::all(), 'save');

            if ($validatorNegocio->passes())
            {
                  $negocio_model = Input::all();
                  $negocio_model = array_add($negocio_model, 'client', Auth::user()->userable);

                  $negocio_model = array_add($negocio_model, 'publicar', false);

                  $negocio = $this->negocio->create($negocio_model);
                  if (isset($negocio))
                  {
                        Session::flash('message', 'Negocio agregado con éxito');
                        return Redirect::route('clientes_negocios.index');
                  }
                  else
                  {
                        Session::flash('error', 'Error al agregar el negocio');
                  }
            }
            return Redirect::back()->withErrors($validatorNegocio->getErrors())->withInput();
      }

      /**
       * Display the specified negocio.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $negocio = $this->negocio->find($id);
            return View::make('clients.negocios.show')->with('negocio', $negocio);
      }

      /**
       * Show the form for editing the specified negocio.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $negocio = $this->negocio->find($id);

            return View::make('clients.negocios.edit')->with('negocio', $negocio);
      }

      /**
       * Update the specified negocio in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $validatorNegocio = new Sph\Services\Validators\Negocio(Input::all(), 'update');

            if ($validatorNegocio->passes())
            {
                  $negocio_model = Input::all();

                  $negocio = $this->negocio->update($id, $negocio_model);
                  if (isset($negocio))
                  {
                        Session::flash('message', 'Negocio editado con éxito');
                        return Redirect::route('clientes_negocios.index');
                  }
                  else
                  {
                        Session::flash('error', 'Error al agregar el negocio');
                  }
            }
            return Redirect::back()->withErrors($validatorNegocio->getErrors())->withInput();
      }

      /**
       * Remove the specified negocio from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            if ($this->negocio->delete($id))
            {
                  Session::flash('message', 'Negocio eliminado');
            }
            else
            {
                  Session::flash('error', 'No se pudo eliminar el negocio');
            }
            return Redirect::route('clientes_negocios.index');
      }

}
