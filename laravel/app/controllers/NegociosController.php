<?php

class NegociosController extends \BaseController {

      /**
       * Display a listing of the resource.
       * GET /negocios
       *
       * @return Response
       */
      public function index()
      {
            View::share('name', 'Negocios - Sphellar');

            /*
             * Del formulario de busqueda, obtenemos nombre y valor y lo metemos en la sesion para 
             * la barra de busqueda.
             */
            //Generamos el query para traer los datos de la base de datos
            //negocios:
            $queryNegocios = Negocio::where('publicar', true)->where('is_activo', true)->orderBy('rank', 'desc');

            $id_ubicacion = Input::get('id_ubicacion');
            if ($id_ubicacion != "")
            {
                  $ubi    = explode(" - ", trim($id_ubicacion));
                  //Obtenemos el nombre del estado
                  $id     = $ubi[0];
                  $nombre = Estado::find($ubi[0])->estado;
                  if (count($ubi) > 1)
                  {
                        $id     = $id . " - " . $ubi[1];
                        $nombre = $nombre . " - " . Zona::find($ubi[1])->zona;
                        $queryNegocios = $queryNegocios->where('zona_id', $ubi[1]);
                  }
                  Session::set('id_ubicacion', $id);
                  Session::set('ubicacion', $nombre);
                  $queryNegocios = $queryNegocios->where('estado_id', $ubi[0]);
                  
            }


            $id_categoria = Input::get('id_categoria');
            if ($id_categoria != "")
            {

                  $cat    = explode(" - ", trim($id_categoria));
                  //Obtenemos el nombre del estado
                  $id     = $cat[0];
                  $nombre = Categoria::find($cat[0])->categoria;
                  
                  if (count($cat) > 1)
                  {
                        $id     = $id . " - " . $cat[1];
                        $nombre = $nombre . " - " . Subcategoria::find($cat[1])->subcategoria;
                        $queryNegocios = $queryNegocios->where('subcategoria_id', $cat[1]);
                  }
                  Session::set('id_categoria', $id);
                  Session::set('categoria', $nombre);
                  $queryNegocios = $queryNegocios->where('categoria_id', $cat[0]);
            }

            $negocios = $queryNegocios->paginate(20);

            $estados    = Estado::all();
            $categorias = Categoria::all();

            return View::make('contenido.negocios_index', compact('negocios', 'estados', 'categorias'));
      }

      /**
       * Display the specified resource.
       * GET /negocios/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $negocio = Negocio::find($id);

            $categorias = Categoria::all();
            $estados    = Estado::all();

            $add_rank = true;

            //Checamos si el usuario esta conectado y si es miembro de sphellar
            if (Auth::check() && Auth::user()->userable_type === 'Miembro')
            {

                  //Checamos si el usuario ya dio like al negocio
                  $negocio_user = Auth::user()->userable->ranknegocios->filter(function($ranknegocio) use($id) {
                        return $ranknegocio->negocio_id == $id;
                  });

                  //No mostrará el rank si ya tiene negocio
                  if (count($negocio_user))
                  {
                        $add_rank = false;
                  }
            }
            View::share('name', $negocio->nombre . ' - Sphellar');

            $promociones = $negocio->promociones;

            return View::make('contenido.show_negocio', compact('negocio', 'estados', 'categorias', 'add_rank', 'promociones'));
      }

}
