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
            $subcategoria = Input::get('sc');
            
            $zona = Input::get('z');
            
            $queryNegocios = \Negocio::where('publicar', true)->where('is_activo', true)->orderBy('rank', 'desc')->orderBy('is_especial', 'desc');
            
            if($subcategoria){
                  $queryNegocios = $queryNegocios->where('subcategoria_id','like',"%$subcategoria%");
            }            
            if($zona){
                  $queryNegocios = $queryNegocios->where('zona_id','like',"%$zona%");
            }            
            $negocios = $queryNegocios->paginate(20);
            
            
            //$eventos = \Evento::where('publicar', true)->where('is_activo', true)->orderBy('rank', 'desc')->orderBy('is_especial', 'desc')->paginate(20);
            $queryEventos = \Evento::where('publicar', true)->where('is_activo', true)->orderBy('rank', 'desc')->orderBy('is_especial', 'desc');
            
            if($subcategoria){
                  $queryEventos = $queryEventos->where('subcategoria_id','like',"%$subcategoria%");
            }            
            if($zona){
                  $queryEventos = $queryEventos->where('zona_id','like',"%$zona%");
            }            
            
            $eventos= $queryEventos->paginate(10);
            
            return View::make('contenido.index')->with(array('negocios' => $negocios,'eventos' => $eventos));
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
