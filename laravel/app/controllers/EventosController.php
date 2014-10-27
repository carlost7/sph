<?php

Use Sph\Storage\Evento\EventoRepository as Evento;
Use Sph\Storage\Categoria\CategoriaRepository as Categoria;
Use Sph\Storage\Estado\EstadoRepository as Estado;

class EventosController extends \BaseController
{

      protected $evento;
      protected $categoria;
      protected $estado;

      public function __construct(Evento $evento, Categoria $categoria, Estado $estado)
      {
            parent::__construct();
            $this->evento = $evento;
            $this->estado = $estado;
            $this->categoria = $categoria;
      }

      /**
       * Display a listing of the resource.
       * GET /eventos
       *
       * @return Response
       */
      public function index()
      {
            View::share('name', 'Cartelera - Sphellar');

            $categorias = $this->categoria->all();
            $estados = $this->estado->all();

            $tipocat = Input::get('tipocat');
            $tipolocal = Input::get('tipolocal');


            $queryEventos = \Evento::where('publicar', true)->where('is_activo', true)->orderBy('rank', 'desc')->orderBy('is_especial', 'desc');
            if (isset($tipocat))
            {
                  $tipocat = explode("-", $tipocat);

                  if (count($tipocat) > 1)
                  {

                        $queryEventos = $queryEventos->where('subcategoria_id', $tipocat[1]);
                  }

                  $queryEventos = $queryEventos->where('categoria_id', $tipocat[0]);
            }

            if ($tipolocal)
            {

                  $tipolocal = explode("-", $tipolocal);


                  if (count($tipolocal) > 1)
                  {

                        $queryEventos = $queryEventos->where('zona_id', $tipolocal[1]);
                  }



                  $queryEventos = $queryEventos->where('estado_id', $tipolocal[0]);
            }


            $eventos = $queryEventos->paginate(20);
            /* $querys = DB::getQueryLog();
              $lastQuery = end($querys);
              //dd($lastQuery); */

            /*Session::set('tipolocal', Input::get('estado'));
            Session::set('tipocat', Input::get('categoria'));*/

            return View::make('contenido.eventos_index')->with(array('eventos' => $eventos,'estados'=>$estados,'categorias'=>$categorias));
      }

      /**
       * Show the form for creating a new resource.
       * GET /eventos/create
       *
       * @return Response
       */
      public function create()
      {
            //
      }

      /**
       * Store a newly created resource in storage.
       * POST /eventos
       *
       * @return Response
       */
      public function store()
      {
            //
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
            $evento = $this->evento->find($id);
            $mapa = null;
            $categorias = $this->categoria->all();
            $estados = $this->estado->all();

            if ($evento->is_especial && count($evento->especial))
            {
                  $config = array();
                  $config['center'] = $evento->especial->mapa;
                  $config['zoom'] = '13';
                  Gmaps::initialize($config);

                  $marker = array();
                  $marker['position'] = $evento->especial->mapa;
                  Gmaps::add_marker($marker);

                  $mapa = Gmaps::create_map();
            }
            
            $add_rank = true;

            
            
            if (Auth::check() && Auth::user()->userable_type === 'Miembro')
            {
                  
                  $evento_user = Auth::user()->userable->rankeventos->filter(function($rankevento) use($id)
                  {
                        return $rankevento->evento_id == $id;
                  });

                  if (count($evento_user))
                  {
                        $add_rank = false;
                  }
            }
            
            
            
            View::share('name', $evento->nombre . ' - Sphellar');

            return View::make('contenido.show_evento')->with(
                    array('evento' => $evento, 
                        'mapa' => $mapa,
                        'estados'=>$estados,
                        'categorias'=>$categorias,
                        'add_rank'=>$add_rank));
      }

      /**
       * Show the form for editing the specified resource.
       * GET /eventos/{id}/edit
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
       * PUT /eventos/{id}
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
       * DELETE /eventos/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            //
      }

}
