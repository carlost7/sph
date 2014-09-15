<?php

use Sph\Storage\Marketing\MarketingRepository as Marketing;
use Sph\Storage\Cliente\ClienteRepository as Client;
use Sph\Storage\Negocio\NegocioRepository as Negocio;
use Sph\Storage\Evento\EventoRepository as Evento;
use Sph\Storage\Promocion\PromocionRepository as Promocion;
use Sph\Storage\Bitacora_cliente\BitacoraClienteRepository as Bitacora_cliente;
use Sph\Storage\Aviso_cliente\AvisoClienteRepository as Aviso_cliente;

class MarketingAvisosController extends \BaseController
{

      protected $cliente;
      protected $marketing;
      protected $negocio;
      protected $evento;
      protected $promocion;
      protected $bitacora_cliente;
      protected $aviso_cliente;

      public function __construct(Client $cliente, Marketing $marketing, Negocio $negocio, Evento $evento, Promocion $promocion, Bitacora_cliente $bitacora_cliente, Aviso_cliente $aviso_cliente)
      {
            parent::__construct();
            $this->client = $cliente;
            $this->marketing = $marketing;
            $this->negocio = $negocio;
            $this->evento = $evento;
            $this->promocion = $promocion;
            $this->bitacora_cliente = $bitacora_cliente;
            $this->aviso_cliente = $aviso_cliente;
            View::share('section','Aviso');
      }

      /**
       * Display a listing of the resource.
       * GET /marketingclientesavisos
       *
       * @return Response
       */
      public function index()
      {
            //Filtra los usuarios pertenecientes a marketing que tienen avisos
            $clientees = Auth::user()->userable->clientes->filter(function($cliente)
            {
                  return $cliente->avisos->count() > 0;
            });

            return View::make('marketing.avisos.index')->with('clientes', $clientees);
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

            //Obtiene los datos de un cliente y los separa para presentarlos en la vista
            $clientee = $this->client->find($id);
            $avisos = $clientee->avisos;
            $contenidos = array();

            foreach ($avisos as $aviso)
            {
                  array_push($contenidos, $aviso->avisable);
            }

            $bitacoras = $clientee->bitacoras;

            return View::make('marketing.avisos.show')
                            ->with(array('cliente' => $clientee,
                                'contenidos' => $contenidos,
                                'bitacoras' => $bitacoras,
            ));
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

            //Despues de hablar con el cliente, y definir si publicarlo o no 
            //creara una bitacora y guardara los datos del usuario,            
            $class = strtolower(Input::get('clase'));
            $object = $this->$class->find($id);
            if (isset($object))
            {
                  $bitacora_model = Input::all();
                  $bitacora_model = array_add($bitacora_model, 'fecha', \Carbon\Carbon::now());
                  $bitacora_model = array_add($bitacora_model, 'client', $object->client);
                  $bitacora = $this->bitacora_cliente->create($bitacora_model);

                  //Activa el contenido del usuario y elimina el aviso de la pagina de marketing
                  if (Input::get('publicar'))
                  {
                        if ($this->$class->activar($id))
                        {
                              $data = array(
                                  'tipo' => Input::get('clase'),
                              );
                              Mail::queue('emails.publicacion_contenido_gratuito', $data, function($message) use ($object)
                              {
                                    $message->to($object->client->user->email, $object->client->nombre)->subject('publicacion de contenido en Sphellar');
                              });

                              Session::flash('message', 'Publicado exitosamente');
                        }
                        else
                        {
                              Session::flash('error', 'Error al publicar el contenido');
                        }
                  }
                  else
                  {
                        $data = array(
                            'tipo' => Input::get('clase'),
                        );
                        Mail::queue('emails.contenido_no_publicado', $data, function($message) use ($object)
                        {
                              $message->to($object->client->user->email, $object->client->nombre)->subject('publicacion de contenido en Sphellar');
                        });
                  }
                  //Elimina el aviso del cliente 
                  $this->aviso_cliente->delete($object->aviso->id);
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


            if ($this->aviso_cliente->delete($id))
            {
                  Session::flash('message', 'Aviso eliminado correctamente');
            }
            else
            {
                  Session::flash('error', 'Error al eliminar el aviso');
            }
            return Redirect::back();
      }

}
