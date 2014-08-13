<?php

use Sph\Storage\Marketing\MarketingRepository as Marketing;
use Sph\Storage\Client\ClientRepository as Client;

class MarketingClientesController extends \BaseController
{

      protected $cliente;
      protected $marketing;

      public function __construct(Client $cliente, Marketing $marketing)
      {
            $this->client = $cliente;
            $this->marketing = $marketing;
      }

      /**
       * Display a listing of marketing
       *
       * @return Response
       */
      public function index()
      {
            $clientees = Auth::user()->userable->clientes;

            return View::make('marketing.clientes.index')->with('clientes', $clientees);
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
            $clientee = $this->client->find($id);
            $negocios = $clientee->negocios;
            $eventos = $clientee->eventos;
            $promociones = $clientee->promociones;
            $bitacoras = $clientee->bitacoras;
            
            return View::make('marketing.clientes.show')
                            ->with(array('cliente' => $clientee,
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
