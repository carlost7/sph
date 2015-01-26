<?php


class MarketingClientesController extends \BaseController
{

      public function __construct(Client $cliente, Marketing $marketing)
      {
            parent::__construct();            
            View::share('section','Clientes');
      }

      /**
       * Display a listing of marketing
       *
       * @return Response
       */
      public function index()
      {
            $clientes = Auth::user()->userable->clientes;

            return View::make('marketing.clientes.index',compact('clientes'));
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
            $cliente = Cliente::find($id);
            $negocios = $cliente->negocios;
            $eventos = $cliente->eventos;
            $promociones = $cliente->promociones;
            $bitacoras = $cliente->bitacoras;

            return View::make('marketing.clientes.show',compact('cliente','negocios','eventos','promociones','bitacoras'));
            
      }      
}
