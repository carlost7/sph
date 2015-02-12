<?php

class EventosController extends \BaseController {

      
      /**
       * Display a listing of the resource.
       * GET /eventos
       *
       * @return Response
       */
      public function index()
      {
            View::share('name', 'Cartelera - Sphellar');

            /*
             * Del formulario de busqueda, obtenemos nombre y valor y lo metemos en la sesion para 
             * la barra de busqueda.
             */
            //Generamos el query para traer los datos de la base de datos
            //negocios:
            $queryEvento = Evento::where('publicar', true)->where('is_activo', true)->orderBy('rank', 'desc');

            $id_ubicacion = Input::get('id_ubicacion');
            if ($id_ubicacion != "")
            {
                  $ubi    = explode("-", trim($id_ubicacion));
                  //Obtenemos el nombre del estado
                  $id     = $ubi[0];
                  Session::set('estados',$id);                  
                  $nombre = Estado::find($ubi[0])->estado;
                  if (count($ubi) > 1 && $ubi[1]!="")
                  {
                        $id     = $id . "-" . $ubi[1];
                        $nombre = $nombre . "-" . Zona::find($ubi[1])->zona;
                        $queryNegocios = $queryEvento->where('zona_id', $ubi[1]);
                  }
                  Session::set('id_ubicacion', $id);
                  Session::set('ubicacion', $nombre);
                  $queryEvento = $queryEvento->where('estado_id', $ubi[0]);
                  
            }


            $id_categoria = Input::get('id_categoria');
            if ($id_categoria != "")
            {

                  $cat    = explode("-", trim($id_categoria));
                  //Obtenemos el nombre del estado
                  $id     = $cat[0];
                  Session::set('categorias',$id);
                  $nombre = Categoria::find($cat[0])->categoria;
                  if (count($cat) > 1 && $cat[1]!="")
                  {
                        $id     = $id . "-" . $cat[1];
                        $nombre = $nombre . "-" . Subcategoria::find($cat[1])->subcategoria;
                        $queryEvento = $queryEvento->where('subcategoria_id', $cat[1]);
                  }
                  Session::set('id_categoria', $id);
                  Session::set('categoria', $nombre);
                  $queryEvento = $queryEvento->where('categoria_id', $cat[0]);
            }

            $eventos = $queryEvento->paginate(20);

            $estados    = Estado::all();
            $categorias = Categoria::all();

            return View::make('contenido.eventos_index', compact('eventos', 'estados', 'categorias'));
      }

      /**
       * Display the specified resource.
       * GET /eventos/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $evento = Evento::find($id);
            View::share('name', $evento->nombre . ' - Sphellar');
            $evento     = Evento::find($id);
            $categorias = Categoria::all();
            $estados    = Estado::all();

            $add_rank = true;

            if (Auth::check() && Auth::user()->userable_type === 'Miembro')
            {

                  $evento_user = Auth::user()->userable->rankeventos->filter(function($rankevento) use($id) {
                        return $rankevento->evento_id == $id;
                  });

                  if (count($evento_user))
                  {
                        $add_rank = false;
                  }
            }

            return View::make('contenido.show_evento',compact('evento','estados','categorias','add_rank'));
      }

}
