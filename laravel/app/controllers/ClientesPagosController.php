<?php

use Illuminate\Events\Dispatcher;
use Sph\Storage\Pago\PagoRepository as Pago;
use Sph\Storage\Cliente\ClienteRepository as Client;
use Sph\Storage\Aviso_cliente\AvisoClienteRepository as Aviso;
use Sph\Storage\Checkout\CheckoutRepository as Checkout;
use Carbon\Carbon;

class clientesPagosController extends \BaseController
{

      protected $pago;
      protected $cliente;
      protected $aviso;
      protected $checkout;
      protected $events;

      public function __construct(Pago $pago, Client $cliente, Aviso $aviso, Checkout $checkout, Dispatcher $events)
      {
            $this->pago = $pago;
            $this->client = $cliente;
            $this->aviso = $aviso;
            $this->checkout = $checkout;
            $this->events = $events;
      }

      /**
       * Display a listing of pagos
       *
       * @return Response
       */
      public function index()
      {
            $necesita_pagar = false;
            $pagos = Auth::user()->userable->pagos()->orderBy('created_at', 'desc')->orderBy('pagado', 'asc')->paginate(5);

            //Check if value is in collection;
            $value = false;
            $key = 'pagado';
            if (in_array($value, $pagos->lists($key)))
            {
                  $necesita_pagar = true;
            }

            return View::make('clientes.pagos.index')->with(array("pagos" => $pagos, 'necesita_pagar' => $necesita_pagar));
      }

      /**
       * Show the form for creating a new negocio
       *
       * @return Response
       */
      public function create()
      {
            return View::make('clientes.pagos.create');
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
            return View::make('clientes.pagos.show')->with('pago', $pago);
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

            return View::make('clientes.pagos.edit')->with('pago', $pago);
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

      public function usar_codigo($id)
      {
            $pago = $this->pago->find($id);
            return View::make('clientes.pagos.codigo')->with('pago', $pago);
      }

      public function guardar_codigo($id)
      {
            $numero = Input::get('numero');
            $codigo = $this->pago->checar_codigo($numero);
            if (isset($codigo))
            {
                  $codigo_model = array('usado' => false, 'client' => Auth::user()->userable);
                  $codigo = $this->pago->usar_codigo($codigo->id, $codigo_model);
                  if (isset($codigo))
                  {
                        $pago_model = array('pagado' => true, 'metodo' => 'Codigo Promocional');
                        $pago = $this->pago->update($id, $pago_model);
                        
                        $this->events->fire('pago_aprobado', array(array($pago->id)));

                        Session::flash('message', 'Código satisfactorio');
                        return Redirect::route('clientes_pagos.index');
                  }
            }
            else
            {
                  Session::flash('error', 'El codigo no existe o ya fue utilizado');
            }
            return Redirect::back();
      }

      public function avisar_marketing($id)
      {
            $pago = $this->pago->find($id);
            if (isset($pago))
            {
                  $aviso_model = array('client' => Auth::user()->userable);
                  $aviso_model = array_add($aviso_model, 'object', $pago->pagable);
                  $aviso = $this->aviso->create($aviso_model);
                  if (isset($aviso))
                  {
                        Session::flash('message', 'Un ejecutivo revisará el contenido y se le avisará por correo cuando este sea publicado');
                  }
            }
            else
            {
                  Session::flash('error', 'El pago no corresponde al usuario');
            }
            return Redirect::back();
      }

}
