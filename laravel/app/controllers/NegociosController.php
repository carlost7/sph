<?php



class NegociosController extends \BaseController
{

      /**
       * Display a listing of the resource.
       * GET /negocios
       *
       * @return Response
       */
      public function index()
      {
            View::share('name', 'Negocios - Sphellar');

            $categorias = Categoria::all();
            $estados = Estado::all();
            
            /*
             * Obtenemos el nombre de la categoria y estado a partir del campo 
             */
            $id_ubicacion = Input::get('id_ubicacion_form');
            Session::set('id_ubicacion', $id_ubicacion);
            $id_categoria = Input::get('id_categoria_form');
            Session::set('id_categoria', $id_categoria);

            //Generamos el query para traer los datos de la base de datos
            //Esto debe pasarse a un controller en algun momento
            //negocios:
            $queryNegocios = Negocio::where('publicar', true)->where('is_activo', true)->orderBy('rank', 'desc');
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
            
            /* $querys = DB::getQueryLog();
              $lastQuery = end($querys);
              //dd($lastQuery); */

            return View::make('contenido.negocios_index',compact('negocios','estados','categorias'));
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
            
            $mapa = null;
            $categorias = $this->categoria->all();
            $estados = $this->estado->all();

            
            if ($negocio->is_especial && count($negocio->especial))
            {
                  $config = array();
                  $config['center'] = $negocio->especial->mapa;
                  $config['zoom'] = '13';
                  Gmaps::initialize($config);


                  $marker = array();
                  $marker['position'] = $negocio->especial->mapa;
                  Gmaps::add_marker($marker);
                  $mapa = Gmaps::create_map();
            }


            $add_rank = true;

            //dd($negocio);
            
            if (Auth::check() && Auth::user()->userable_type === 'Miembro')
            {
                  $negocio_user = Auth::user()->userable->ranknegocios->filter(function($ranknegocio) use($id)
                  {
                        return $ranknegocio->negocio_id == $id;
                  });

                  if (count($negocio_user))
                  {
                        $add_rank = false;
                  }
            }
            
            View::share('name', $negocio->nombre . ' - Sphellar');

            //dd($negocio);
            
            return View::make('contenido.show_negocio')->with(
                            array('negocio' => $negocio,
                                'mapa' => $mapa,
                                'estados' => $estados,
                                'categorias' => $categorias,
                                'add_rank' => $add_rank));
      }

}
