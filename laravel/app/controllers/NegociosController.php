<?php

Use Sph\Storage\Negocio\NegocioRepository as Negocio;
Use Sph\Storage\Categoria\CategoriaRepository as Categoria;
Use Sph\Storage\Estado\EstadoRepository as Estado;

class NegociosController extends \BaseController
{

      protected $negocio;
      protected $categoria;
      protected $estado;

      public function __construct(Negocio $negocio, Categoria $categoria, Estado $estado)
      {
            parent::__construct();
            $this->negocio = $negocio;
            $this->estado = $estado;
            $this->categoria = $categoria;
      }

      /**
       * Display a listing of the resource.
       * GET /negocios
       *
       * @return Response
       */
      public function index()
      {
            View::share('name','Negocios - Sphellar');
            
            $tipocat = Input::get('tipocat');
            $tipolocal = Input::get('tipolocal');

            $categorias = $this->categoria->all();
            $estados = $this->estado->all();
            

            $queryNegocios = \Negocio::where('publicar', true)->where('is_activo', true)->orderBy('rank', 'desc')->orderBy('is_especial', 'desc');
            
            if (isset($tipocat))
            {
                  $tipocat = explode("-", $tipocat);

                  if (count($tipocat) > 1)
                  {
                        $queryNegocios = $queryNegocios->where('subcategoria_id', $tipocat[1]);                        
                  }
                  $queryNegocios = $queryNegocios->where('categoria_id', $tipocat[0]);                  
            }

            if ($tipolocal)
            {
                  $tipolocal = explode("-", $tipolocal);

                  if (count($tipolocal) > 1)                  {
                        $queryNegocios = $queryNegocios->where('zona_id', $tipolocal[1]);                        
                  }

                  $queryNegocios = $queryNegocios->where('estado_id', $tipolocal[0]);
                  
            }

            $negocios = $queryNegocios->paginate(20);

            /*$querys = DB::getQueryLog();
            $lastQuery = end($querys);
            //dd($lastQuery);*/
            
            Session::set('tipolocal',Input::get('estado'));
            Session::set('tipocat',Input::get('categoria'));
            
            return View::make('contenido.negocios_index')->with(array('negocios' => $negocios,'estados'=>$estados,'categorias'=>$categorias));
      }

      /**
       * Show the form for creating a new resource.
       * GET /negocios/create
       *
       * @return Response
       */
      public function create()
      {
            //
      }

      /**
       * Store a newly created resource in storage.
       * POST /negocios
       *
       * @return Response
       */
      public function store()
      {
            //
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
            $negocio = $this->negocio->find($id);
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
            
            View::share('name',$negocio->nombre.' - Sphellar');
            
            return View::make('contenido.show_negocio')->with(array('negocio' => $negocio, 'mapa' => $mapa,'estados'=>$estados,'categorias'=>$categorias));
      }

      /**
       * Show the form for editing the specified resource.
       * GET /negocios/{id}/edit
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
       * PUT /negocios/{id}
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
       * DELETE /negocios/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            //
      }

}
