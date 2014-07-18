<?php

use Sph\Storage\Evento\EventoRepository as Evento;
use Carbon\Carbon;

class ClientsEventosController extends \BaseController
{

      protected $evento;

      public function __construct(Evento $evento)
      {
            $this->evento = $evento;
      }

      /**
       * Display a listing of eventos
       *
       * @return Response
       */
      public function index()
      {
            $eventos = Auth::user()->userable->eventos;
            return View::make('clients.eventos.index')->with("eventos", $eventos);
      }

      /**
       * Show the form for creating a new negocio
       *
       * @return Response
       */
      public function create()
      {
            return View::make('clients.eventos.create');
      }

      /**
       * Store a newly created negocio in storage.
       *
       * @return Response
       */
      public function store()
      {
            $validatorEvento = new Sph\Services\Validators\Evento(Input::all(), 'save');

            if ($validatorEvento->passes())
            {
                  $evento_model = Input::all();
                  $evento_model = array_add($evento_model, 'client', Auth::user()->userable);
                  $evento_model = array_add($evento_model, 'publicar', false);

                  $evento = $this->evento->create($evento_model);
                  if (isset($evento))
                  {
                        Session::flash('message', 'Evento agregado con éxito');
                        return Redirect::route('clientes_eventos.index');
                  }
                  else
                  {
                        Session::flash('error', 'Error al agregar el evento');
                  }
            }
            return Redirect::back()->withErrors($validatorEvento->getErrors())->withInput();
      }

      /**
       * Display the specified negocio.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $evento = $this->evento->find($id);
            return View::make('clients.eventos.show')->with('evento', $evento);
      }

      /**
       * Show the form for editing the specified negocio.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $evento = $this->evento->find($id);

            return View::make('clients.eventos.edit')->with('evento', $evento);
      }

      /**
       * Update the specified negocio in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $validatorEvento = new Sph\Services\Validators\Evento(Input::all(), 'update');

            if ($validatorEvento->passes())
            {
                  $evento_model = Input::all();

                  $evento = $this->evento->update($id, $evento_model);
                  if (isset($evento))
                  {
                        Session::flash('message', 'Evento editado con éxito');
                        return Redirect::route('clientes_eventos.index');
                  }
                  else
                  {
                        Session::flash('error', 'Error al agregar el evento');
                  }
            }
            return Redirect::back()->withErrors($validatorEvento->getErrors())->withInput();
      }

      /**
       * Remove the specified negocio from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            if ($this->evento->delete($id))
            {
                  Session::flash('message', 'Evento eliminado');
            }
            else
            {
                  Session::flash('error', 'No se pudo eliminar el evento');
            }
            return Redirect::route('clientes_eventos.index');
      }

}
