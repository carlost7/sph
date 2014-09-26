<?php

Use Sph\Storage\Negocio\NegocioRepository as Negocio;

class NegociosController extends \BaseController
{

      protected $negocio;

      public function __construct(Negocio $negocio)
      {
            parent::__construct();
            $this->negocio = $negocio;
      }

      /**
       * Display a listing of the resource.
       * GET /negocios
       *
       * @return Response
       */
      public function index()
      {
            View::share('name','Negocois - Sphellar');
            
            $tipocat = Input::get('tipocat');
            $tipolocal = Input::get('tipolocal');
            
            $queryNegocios = \Negocio::where('publicar', true)->where('is_activo', true)->orderBy('rank', 'desc')->orderBy('is_especial', 'desc');
            
            return View::make('contenido.negocios_index')->with(array('negocios' => $negocios));            
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
            
            return View::make('contenido.show_negocio')->with(array('negocio' => $negocio, 'mapa' => $mapa));
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
