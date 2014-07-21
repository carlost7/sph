<?php

use Sph\Storage\Pago\PagoRepository as Pago;
use Carbon\Carbon;

class ClientsPagosController extends \BaseController
{

      protected $pago;

      public function __construct(Pago $pago)
      {
            $this->pago = $pago;
      }

      /**
       * Display a listing of pagos
       *
       * @return Response
       */
      public function index()
      {
            $pagos = Auth::user()->userable->pagos;            
            return View::make('clients.pagos.index')->with("pagos", $pagos);
      }

      /**
       * Show the form for creating a new negocio
       *
       * @return Response
       */
      public function create()
      {
            return View::make('clients.pagos.create');
      }

      /**
       * Store a newly created negocio in storage.
       *
       * @return Response
       */
      public function store()
      {
            $validatorPromocion = new Sph\Services\Validators\Pago(Input::all(), 'save');

            if ($validatorPromocion->passes())
            {
                  $pagos_model = Input::all();
                  $pagos_model = array_add($pagos_model, 'client', Auth::user()->userable);
                  $pagos_model = array_add($pagos_model, 'publicar', false);

                  $pago = $this->pago->create($pagos_model);
                  if (isset($pago))
                  {
                        Session::flash('message', 'Pago agregado con éxito');
                        return Redirect::route('clientes_pagos.index');
                  }
                  else
                  {
                        Session::flash('error', 'Error al agregar el pago');
                  }
            }
            return Redirect::back()->withErrors($validatorPromocion->getErrors())->withInput();
      }

      /**
       * Display the specified negocio.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $pago = $this->pago->find($id);
            return View::make('clients.pagos.show')->with('pago', $pago);
      }

      /**
       * Show the form for editing the specified negocio.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $pago = $this->pago->find($id);

            return View::make('clients.pagos.edit')->with('pago', $pago);
      }

      /**
       * Update the specified negocio in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $validatorPromocion = new Sph\Services\Validators\Pago(Input::all(), 'update');

            if ($validatorPromocion->passes())
            {
                  $pagos_model = Input::all();

                  $pago = $this->pago->update($id, $pagos_model);
                  if (isset($pago))
                  {
                        Session::flash('message', 'Pago editado con éxito');
                        return Redirect::route('clientes_pagos.index');
                  }
                  else
                  {
                        Session::flash('error', 'Error al agregar la promoción');
                  }
            }
            return Redirect::back()->withErrors($validatorPromocion->getErrors())->withInput();
      }

      /**
       * Remove the specified negocio from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            if ($this->pago->delete($id))
            {
                  Session::flash('message', 'Pago eliminado');
            }
            else
            {
                  Session::flash('error', 'No se pudo eliminar el pago');
            }
            return Redirect::route('clientes_pagos.index');
      }

}
