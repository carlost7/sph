<?php

use Sph\Storage\Marketing\MarketingRepository as Marketing;
use Sph\Storage\Client\ClientRepository as Client;

class MarketingClientesController extends \BaseController
{

      protected $client;
      protected $marketing;

      public function __construct(Client $client, Marketing $marketing)
      {
            $this->client = $client;
            $this->marketing = $marketing;
      }

      /**
       * Display a listing of marketing
       *
       * @return Response
       */
      public function index()
      {
            $clientes = Auth::user()->userable->clientes;

            return View::make('marketing.clientes.index')->with('clientes', $clientes);
      }

      /**
       * Display the specified resource.
       * GET /marketingclientes/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $cliente = $this->client->find($id);
            $negocios = $cliente->negocios;
            $eventos = $cliente->eventos;
            $promociones = $cliente->promociones;
            $bitacoras = $cliente->bitacoras;
            
            return View::make('marketing.clientes.show')
                            ->with(array('cliente' => $cliente,
                                'negocios' => $negocios,
                                'eventos' => $eventos,
                                'promociones' => $promociones,
                                'bitacoras' => $bitacoras,
                              ));
      }

      /**
       * Show the form for editing the specified resource.
       * GET /marketingclientes/{id}/edit
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            //
      }

      /**
       * Update the specified resource in storage.
       * PUT /marketingclientes/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            //
      }

      /**
       * Remove the specified resource from storage.
       * DELETE /marketingclientes/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            //
      }

}
