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

            View::share('name', 'Guia - Sphellar');

            /*
             * We set the hidden and unhidden values of the search bar
             */
            $nombre_ubicacion = Input::get('nombre_ubicacion');

            Session::set('ubicacion', $nombre_ubicacion);

            $nombre_categoria = Input::get('nombre_categoria');
            Session::set('categoria', $nombre_categoria);

            $id_ubicacion = Input::get('id_ubicacion');

            Session::set('id_ubicacion', $id_ubicacion);

            $id_categoria = Input::get('id_categoria');

            Session::set('id_categoria', $id_categoria);


            //Generamos el query para traer los datos de la base de datos
            //Esto debe pasarse a un controller en algun momento
            //negocios:
            $queryNegocios = \Negocio::where('publicar', true)->where('is_activo', true)->orderBy('rank', 'desc');
            //Obtenemos los negocios que tengan categorias
            if ($id_categoria != "")
            {
                  //Separamos la categoria y la subcategoria
                  $cat = explode("-", $id_categoria);
                  if (count($cat) > 1)
                  {
                        //Agregamos la subcategoria
                        $queryNegocios = $queryNegocios->where('subcategoria_id', $cat[1]);
                  }

                  //Agregamos la categoria
                  $queryNegocios = $queryNegocios->where('categoria_id', $cat[0]);
            }

            if ($id_ubicacion != "")
            {
                  $ubi = explode("-", $id_ubicacion);
                  if (count($ubi) > 1)
                  {
                        $queryNegocios = $queryNegocios->where('zona_id', $ubi[1]);
                  }
                  $queryNegocios = $queryNegocios->where('estado_id', $ubi[0]);
            }

            $negocios = $queryNegocios->paginate(20);
            $eventos = array();

            //$eventos = $queryEventos->take(10)->get();
            /* $querys = DB::getQueryLog();
              $lastQuery = end($querys);
              dd($lastQuery);
             */
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

            foreach ($estados as $estado) {
                  array_push($suggestions, array('value' => $estado->estado, 'data' => $estado->id));
            }

            foreach ($zonas as $zona) {
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

            foreach ($categorias as $categoria) {
                  array_push($suggestions, array('value' => $categoria->categoria, 'data' => $categoria->id));
            }

            foreach ($subcategorias as $subcategoria) {
                  array_push($suggestions, array('value' => $subcategoria->categoria->categoria . " - " . $subcategoria->subcategoria, 'data' => $subcategoria->categoria->id . '-' . $subcategoria->id));
            }

            $result = array("suggestions" => $suggestions);

            return Response::json($result);
      }

}
