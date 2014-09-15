<?php

use Sph\Storage\Negocio\NegocioRepository as Negocio;
use Sph\Storage\Evento\EventoRepository as Evento;
use Sph\Storage\Zona\ZonaRepository as Zona;
use Sph\Storage\Estado\EstadoRepository as Estado;
use Sph\Storage\Categoria\CategoriaRepository as Categoria;
use Sph\Storage\Subcategoria\SubcategoriaRepository as Subcategoria;

class ContenidoController extends \BaseController
{

      protected $negocio;
      protected $evento;
      protected $zona;
      protected $estado;
      protected $categoria;
      protected $subcategoria;

      public function __construct(Evento $evento, Negocio $negocio, Zona $zona, Estado $estado, Categoria $categoria, Subcategoria $subcategoria)
      {
            parent::__construct();
            $this->evento = $evento;
            $this->negocio = $negocio;
            $this->zona = $zona;
            $this->estado = $estado;
            $this->categoria = $categoria;
            $this->subcategoria = $subcategoria;            
      }

      /**
       * Display a listing of the resource.
       * GET /contenido
       *
       * @return Response
       */
      public function index()
      {

            View::share('name','Sphellar');
            
            $tipocat = Input::get('tipocat');
            $tipolocal = Input::get('tipolocal');


            $queryNegocios = \Negocio::where('publicar', true)->where('is_activo', true)->orderBy('rank', 'desc')->orderBy('is_especial', 'desc');
            $queryEventos = \Evento::where('publicar', true)->where('is_activo', true)->orderBy('rank', 'desc')->orderBy('is_especial', 'desc');
            if (isset($tipocat))
            {
                  $tipocat = explode("-", $tipocat);

                  if (count($tipocat) > 1)
                  {
                        $queryNegocios = $queryNegocios->where('subcategoria_id', $tipocat[1]);
                        $queryEventos = $queryEventos->where('subcategoria_id', $tipocat[1]);
                  }
                  $queryNegocios = $queryNegocios->where('categoria_id', $tipocat[0]);
                  $queryEventos = $queryEventos->where('categoria_id', $tipocat[0]);
            }

            if ($tipolocal)
            {

                  $tipolocal = explode("-", $tipolocal);


                  if (count($tipolocal) > 1)
                  {
                        $queryNegocios = $queryNegocios->where('zona_id', $tipolocal[1]);
                        $queryEventos = $queryEventos->where('zona_id', $tipolocal[1]);
                  }


                  $queryNegocios = $queryNegocios->where('estado_id', $tipolocal[0]);
                  $queryEventos = $queryEventos->where('estado_id', $tipolocal[0]);
            }

            $negocios = $queryNegocios->paginate(20);
            $eventos = $queryEventos->take(10)->get();
            /*$querys = DB::getQueryLog();
            $lastQuery = end($querys);
            //dd($lastQuery);*/
            
            Session::set('tipolocal',Input::get('estado'));
            Session::set('tipocat',Input::get('categoria'));
            
            return View::make('contenido.index')->with(array('negocios' => $negocios, 'eventos' => $eventos));
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

      public function getCatalogoZonas()
      {
            $zonas = $this->zona->getZonaLike(Input::get('query'));
            $estados = $this->estado->getEstadoLike(Input::get('query'));

            $suggestions = array();

            foreach ($estados as $estado)
            {
                  array_push($suggestions, array('value' => $estado->estado, 'data' => $estado->id));
            }

            foreach ($zonas as $zona)
            {
                  array_push($suggestions, array('value' => $zona->estado->estado . " - " . $zona->zona, 'data' => $zona->estado->id . '-' . $zona->id));
            }

            $result = array("suggestions" => $suggestions);

            return Response::json($result);
      }

      public function getCatalogoCategorias()
      {
            $subcategorias = $this->subcategoria->getSubcategoriaLike(Input::get('query'));
            $categorias = $this->categoria->getCategoriaLike(Input::get('query'));

            $suggestions = array();

            foreach ($categorias as $categoria)
            {
                  array_push($suggestions, array('value' => $categoria->categoria, 'data' => $categoria->id));
            }

            foreach ($subcategorias as $subcategoria)
            {
                  array_push($suggestions, array('value' => $subcategoria->categoria->categoria . " - " . $subcategoria->subcategoria, 'data' => $subcategoria->categoria->id . '-' . $subcategoria->id));
            }

            $result = array("suggestions" => $suggestions);

            return Response::json($result);
      }

}
