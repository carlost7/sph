<?php

use Sph\Storage\Marketing\MarketingRepository as Marketing;
use Sph\Storage\Client\ClientRepository as Client;
use Sph\Storage\Negocio\NegocioRepository as Negocio;
use Sph\Storage\Evento\EventoRepository as Evento;
use Sph\Storage\Promocion\PromocionRepository as Promocion;



class MarketingAvisosController extends \BaseController
{

      protected $client;
      protected $marketing;
      protected $negocio;
      protected $evento;
      protected $promocion;
      protected $bitacora;
      

      public function __construct(Client $client, Marketing $marketing, Negocio $negocio, Evento $evento, Promocion $promocion)
      {
            $this->client = $client;
            $this->marketing = $marketing;
            $this->negocio = $negocio;
            $this->evento = $evento;
            $this->promocion = $promocion;
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
            });;

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

            return View::make('marketing.avisos.show')
                            ->with(array('cliente' => $cliente,
                                'negocios' => $negocios,
                                'eventos' => $eventos,
                                'promociones' => $promociones,
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
      public function update($id)
      {
            $class = strtolower(Input::get('class'));
            $object = $this->$class->find($id);
            if(isset($object)){
                  if(Input::get('publicar')){
                        if($this->$class->activar($id)){
                              echo "publicado";
                        }else{
                              echo "no publicado";
                        }
                  }else{
                        echo "no se publicara";
                  }
                  
                  //Guardar bitacora
                  
                  //Avisar por correo al usuario
            }else{
                  echo "no existe";
            }
            
            echo "adios";
            
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
