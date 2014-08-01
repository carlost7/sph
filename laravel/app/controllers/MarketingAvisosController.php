<?php

use Sph\Storage\Marketing\MarketingRepository as Marketing;
use Sph\Storage\Client\ClientRepository as Client;
use Sph\Storage\Negocio\NegocioRepository as Negocio;
use Sph\Storage\Evento\EventoRepository as Evento;
use Sph\Storage\Promocion\PromocionRepository as Promocion;
use Sph\Storage\Bitacora_cliente\BitacoraClienteRepository as Bitacora_cliente;

class MarketingAvisosController extends \BaseController
{

      protected $client;
      protected $marketing;
      protected $negocio;
      protected $evento;
      protected $promocion;
      protected $bitacora_cliente;

      public function __construct(Client $client, Marketing $marketing, Negocio $negocio, Evento $evento, Promocion $promocion, Bitacora_cliente $bitacora_cliente)
      {
            $this->client = $client;
            $this->marketing = $marketing;
            $this->negocio = $negocio;
            $this->evento = $evento;
            $this->promocion = $promocion;
            $this->bitacora_cliente = $bitacora_cliente;
      }

      /**
       * Display a listing of the resource.
       * GET /marketingclientesavisos
       *
       * @return Response
       */
      public function index()
      {
            $clientes = Auth::user()->userable->clientes->filter(function($clientes)
            {
                  return $clientes->tiene_aviso == true;
            });
            ;

            return View::make('marketing.avisos.index')->with('clientes', $clientes);
      }

      /**
       * Display the specified resource.
       * GET /marketingclientesavisos/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $cliente = $this->client->find($id);
            $negocios = $cliente->negocios()->where('publicar', false)->get();
            $eventos = $cliente->eventos()->where('publicar', false)->get();
            $promociones = $cliente->promociones()->where('publicar', false)->get();
            $bitacoras = $cliente->promociones()->where('publicar', false)->get();

            $total = 0;
            $total += $negocios->count();
            $total += $eventos->count();
            $total += $promociones->count();

            if ($total)
            {
                  return View::make('marketing.avisos.show')
                                  ->with(array('cliente' => $cliente,
                                      'negocios' => $negocios,
                                      'eventos' => $eventos,
                                      'promociones' => $promociones,
                                      'bitacoras' => $bitacoras,
                  ));
            }
            else
            {
                  $client_model = array('tiene_aviso' => false);
                  if ($this->client->update($id, $client_model))
                  {
                        return Redirect::route('marketing_avisos.index');
                  }
                  else
                  {
                        Session::flash('error', 'Error al actualizar el usuario');
                        return Redirect::route('marketing_avisos.index');
                  }
            }
      }

      /**
       * Update the specified resource in storage.
       * PUT /marketingclientesavisos/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function publicar($id)
      {

            $class = strtolower(Input::get('clase'));
            $object = $this->$class->find($id);
            if (isset($object))
            {
                  $bitacora_model = array(Input::all());
                  $bitacora_model = array_add($bitacora_model, 'fecha', \Carbon\Carbon::now());
                  $bitacora_model = array_add($bitacora_model, 'client', $object->cliente);
                  $bitacora = $this->bitacora_cliente->create($bitacora_model);

                  if (Input::get('publicar'))
                  {
                        if ($this->$class->activar($id))
                        {
                              $data = array(
                                  'tipo' => get_class($pago->pagable),
                              );
                              Mail::queue('emails.publicacion_contenido_gratuito', $data, function($message)
                              {
                                    $message->to(Auth::user()->email, Auth::user()->userable->name)->subject('Confirmación de Registro de Sphellar');
                              });

                              Session::flash('message', 'Publicado exitosamente');
                        }
                        else
                        {
                              Session::flash('error', 'Error al publicar el contenido');
                        }
                  }
            }
            else
            {
                  Session::flash('error', 'No existe ese id');
            }

            return Redirect::back();
      }

      /**
       * Remove the specified resource from storage.
       * DELETE /marketingclientesavisos/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            //
      }

}
