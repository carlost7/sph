<?php

Use Sph\Storage\Evento\EventoRepository as Evento;

class EventosController extends \BaseController
{

      protected $evento;

      public function __construct(Evento $evento)
      {
            $this->evento = $evento;
      }
      
      /**
       * Display a listing of the resource.
       * GET /eventos
       *
       * @return Response
       */
      public function index()
      {
            View::share('tipocat',Input::get('categoria'));
            View::share('tipolocal',Input::get('estado'));
            
            $eventos = \Evento::where('publicar', true)->where('is_activo', true)->orderBy('rank', 'desc')->orderBy('is_especial', 'desc')->paginate(10);
            return View::make('contenido.eventos_index')->with(array('eventos' => $eventos));
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

            return View::make('contenido.show_evento')->with(array('evento' => $evento, 'mapa' => $mapa));
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
