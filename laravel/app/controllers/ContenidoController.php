<?php

use Sph\Storage\Negocio\NegocioRepository as Negocio;
use Sph\Storage\Evento\EventoRepository as Evento;

class ContenidoController extends \BaseController
{

      protected $negocio;
      protected $evento;

      public function __construct(Evento $evento, Negocio $negocio)
      {
            parent::setupCatalog();
            $this->evento = $evento;
            $this->negocio = $negocio;
      }

      /**
       * Display a listing of the resource.
       * GET /contenido
       *
       * @return Response
       */
      public function index()
      {

            $negocios = \Negocio::where('publicar', true)->where('is_activo', true)->orderBy('rank', 'desc')->orderBy('is_especial', 'desc')->paginate(20);

            return View::make('contenido.index')->with(array('negocios' => $negocios));
      }

      /**
       * Display the specified resource.
       * GET /contenido/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            //
      }

}
