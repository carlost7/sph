<?php

use Sph\Storage\Pago\PagoRepository as Pago;
use Sph\Storage\Client\ClientRepository as Client;
use Sph\Storage\Aviso_cliente\AvisoClienteRepository as Aviso;
use Sph\Storage\Checkout\CheckoutRepository as Checkout;
use Carbon\Carbon;

class ClientsPagosController extends \BaseController
{

      protected $pago;
      protected $client;
      protected $aviso;
      protected $checkout;

      public function __construct(Pago $pago, Client $client, Aviso $aviso, Checkout $checkout)
      {
            $this->pago = $pago;
            $this->client = $client;
            $this->aviso = $aviso;
            $this->checkout = $checkout;
      }

      /**
       * Display a listing of pagos
       *
       * @return Response
       */
      public function index()
      {
            $pagos = Auth::user()->userable->pagos()->orderBy('created_at', 'desc')->orderBy('pagado', 'asc')->paginate(5);
            //->sortByDesc('created_at')->sortBy('pagado');
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

      public function usar_codigo($id)
      {
            $pago = $this->pago->find($id);
            return View::make('clients.pagos.codigo')->with('pago', $pago);
      }

      public function guardar_codigo($id)
      {
            $numero = Input::get('numero');
            $codigo = $this->pago->checar_codigo($numero);
            if (isset($codigo))
            {
                  $codigo_model = array('usado' => true, 'client' => Auth::user()->userable);
                  $codigo = $this->pago->usar_codigo($codigo->id, $codigo_model);
                  if (isset($codigo))
                  {
                        $pago_model = array('pagado' => true, 'metodo' => 'Codigo Promocional');
                        $pago = $this->pago->update($id, $pago_model);
                        if ($this->pago->publicar_contenido($pago))
                        {
                              $client_model = array('tiene_aviso' => false);
                              $this->client->update($pago->client->id, $client_model);

                              $data = array(
                                  'tipo' => get_class($pago->pagable),
                              );
                              Mail::queue('emails.publicacion_contenido_pago', $data, function($message)
                              {
                                    $message->to(Auth::user()->email, Auth::user()->userable->name)->subject('Confirmación de Registro de Sphellar');
                              });

                              Session::flash('message', 'Código satisfactorio');
                              return Redirect::route('clientes_pagos.index');
                        }
                        else
                        {
                              Session::flash('message', 'Código satisfactorio');
                        }
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

      public function pagar($id)
      {

            //Obtiene el id del pago y obtiene el costo del pago por tipo de elemento
            $pago = $this->pago->find($id);

            $preference_data = array(
                "items" => array(
                    array(
                        "title" => $pago->nombre,
                        "quantity" => 1,
                        "currency_id" => "MEX",
                        "unit_price" => doubleval($pago->monto)
                    )
                ),
                "payer" => array(
                    "name" => Auth::user()->userable->nombre,
                    "email" => Auth::user()->email,
                ),
                "back_urls" => array(
                    "success" => URL::Route("clientes_pagos.index"),
                    "failure" => URL::Route("clientes_pagos.index"),
                    "pending" => URL::Route("clientes_pagos.index"),
                ),
                "external_reference" => $pago->id,
            );


            $preference = $this->checkout->generar_preferencia($preference_data);
            if (isset($preference))
            {
                  
                  $link = $preference['response'][Config::get('payment.init_point')];
                  return Redirect::away($link);
            }
            else
            {
                  Session::flash('error', 'Ocurrio un error al tratar de generar el pago.');
                  return Redirect::back();
            }
      }

}
