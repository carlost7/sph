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

            $categorias = Categoria::all();
            $estados    = Estado::all();

            $tipocat   = Input::get('tipocat');
            $tipolocal = Input::get('tipolocal');


            $queryEventos = Evento::where('publicar', true)->where('is_activo', true)->orderBy('rank', 'desc')->orderBy('is_especial', 'desc');
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
            
            Session::set('tipolocal', Input::get('estado'));
            Session::set('tipocat', Input::get('categoria'));

            return View::make('contenido.eventos_index',compact('eventos','estados','categorias'));
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
