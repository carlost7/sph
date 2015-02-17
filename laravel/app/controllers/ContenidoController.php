<?php

class ContenidoController extends \BaseController
{

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
            //negocios:
            $queryNegocios = Negocio::where('publicar', true)->where('is_activo', true)->orderBy('rank', 'desc');
            //eventos:
            $queryEventos = Evento::where('publicar', true)->where('is_activo', true)->orderBy('rank', 'desc');
            //Obtenemos los negocios que tengan categorias
            if ($id_categoria != "")
            {
                  //Separamos la categoria y la subcategoria
                  $cat = explode("-", $id_categoria);
                  if (count($cat) > 1)
                  {
                        //Agregamos la subcategoria
                        $queryNegocios = $queryNegocios->where('subcategoria_id', $cat[1]);
                        $queryEventos = $queryEventos->where('subcategoria_id', $cat[1]);
                  }

                  //Agregamos la categoria
                  $queryNegocios = $queryNegocios->where('categoria_id', $cat[0]);
                  $queryEventos = $queryEventos->where('categoria_id', $cat[0]);
            }

            if ($id_ubicacion != "")
            {
                  $ubi = explode("-", $id_ubicacion);
                  if (count($ubi) > 1)
                  {
                        $queryNegocios = $queryNegocios->where('zona_id', $ubi[1]);
                        $queryEventos = $queryEventos->where('zona_id', $ubi[1]);
                  }
                  $queryNegocios = $queryNegocios->where('estado_id', $ubi[0]);
                  $queryEventos = $queryEventos->where('estado_id', $ubi[0]);
            }

            $negocios = $queryNegocios->paginate(10);
            $eventos = $queryEventos->paginate(5);

            return View::make('contenido.index')->with(array('negocios' => $negocios, 'eventos' => $eventos));
      }

      
      public function getCatalogoZonas()
      {
            $zonas = Zona::with('estado')->where('zona','LIKE',"%".Input::get('query')."%")->take(25)->get();;
            $estados = Estado::where('estado','LIKE',"%".Input::get('query')."%")->take(4)->get();

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
            $subcategorias = Subcategoria::with('categoria')->where('subcategoria','LIKE',"%".Input::get('query')."%")->take(10)->get();;
            $categorias = Categoria::where('categoria','LIKE',"%".Input::get('query')."%")->take(10)->get();

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
