<?php

use Sph\Storage\Negocio\NegocioRepository as Negocio;
use Sph\Storage\Pago\PagoRepository as Pago;

class clientesNegociosController extends \BaseController
{

      protected $negocio;
      protected $pago;

      public function __construct(Negocio $negocio, Pago $pago)
      {
            $this->negocio = $negocio;
            $this->pago = $pago;
      }

      /**
       * Display a listing of negocios
       *
       * @return Response
       */
      public function index()
      {
            $negocios = Auth::user()->userable->negocios;
            return View::make('clientes.negocios.index')->with("negocios", $negocios);
      }

      /**
       * Show the form for creating a new negocio
       *
       * @return Response
       */
      public function create()
      {
            return View::make('clientes.negocios.create');
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
                        $pago_model = array(
                            'nombre' => 'Publicación de Negocio',
                            'descripcion' => $negocio->nombre,
                            'monto' => Config::get('costos.negocio'),
                            'client' => Auth::user()->userable,
                        );
                        $pago = $this->pago->create($pago_model);
                        if (isset($pago))
                        {
                              if ($this->negocio->agregar_pago($negocio, $pago))
                              {
                                    Session::flash('message', 'Negocio agregado con éxito');
                                    return Redirect::route('clientes_negocios.index');
                              }
                        }
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
            return View::make('clientes.negocios.show')->with('negocio', $negocio);
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

            return View::make('clientes.negocios.edit')->with('negocio', $negocio);
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
            $validatorNegocioEspecial = new Sph\Services\Validators\Negocio_especial(Input::all(), 'update');

            if ($validatorNegocio->passes() & $validatorNegocioEspecial->passes())
            {
                  $negocio_model = Input::all();

                  $especial = array('horario' => Input::get('horario'));

                  $negocio_model = array_add($negocio_model, 'especial', $especial);

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

            $negocio_messages = ($validatorNegocio->getErrors() != null) ? $validatorNegocio->getErrors()->all() : array();
            $negocio_especial_messages = ($validatorNegocioEspecial->getErrors() != null) ? $validatorNegocioEspecial->getErrors()->all() : array();
            $validationMessages = array_merge_recursive($negocio_messages, $negocio_especial_messages);

            return Redirect::back()->withErrors($validationMessages)->withInput();
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

      /*
       * Funcion que le permite al usuario activar su negocio nuevamente
       * 
       */

      public function activar($id)
      {
            $negocio = $this->negocio->find($id);
            if ($negocio->client->id == Auth::user()->userable->id)
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
