<?php

use Sph\Storage\Evento\EventoRepository as Evento;
use Sph\Storage\Pago\PagoRepository as Pago;
use Carbon\Carbon;

class ClientsEventosController extends \BaseController
{

      protected $evento;
      protected $pago;

      public function __construct(Evento $evento, Pago $pago)
      {
            $this->evento = $evento;
            $this->pago = $pago;
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
                        $pago_model = array(
                            'nombre' => 'Publicación de Evento',
                            'descripcion' => $evento->nombre,
                            'monto' => 100.00,
                            'client' => Auth::user()->userable,
                        );
                        $pago = $this->pago->create($pago_model);
                        if (isset($pago))
                        {
                              if ($this->evento->agregar_pago($evento, $pago))
                              {
                                    Session::flash('message', 'Evento agregado con éxito');
                                    return Redirect::route('clientes_eventos.index');
                              }
                        }
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
            return View::make('clients.eventos.edit')->with(array('evento'=>$evento));
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
            $validatorEventoEspecial = new Sph\Services\Validators\Evento_especial(Input::all(), 'update');

            if ($validatorEvento->passes() & $validatorEventoEspecial->passes())
            {
                  $evento_model = Input::all();
                  $especial = array('imagenes'=>Input::get('imagenes'));
                  
                  $evento_model = array_add($evento_model, 'especial', $especial);

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
            
            $evento_messages = ($validatorEvento->getErrors() != null) ? $validatorEventoEspecial->getErrors()->all() : array();
            $evento_especial_messages = ($validatorEventoEspecial->getErrors() != null) ? $validatorEventoEspecial->getErrors()->all() : array();
            $validationMessages = array_merge_recursive($evento_messages, $evento_especial_messages);
            
            return Redirect::back()->withErrors($validationMessages)->withInput();
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

      public function activar($id)
      {
            $evento = $this->evento->find($id);
            if($evento->client->id == Auth::user()->userable->id){
                  if($this->evento->activar($id)){
                        Session::flash('message','Activación correcta');
                        return Redirect::route('clientes_eventos.index');
                  }else{
                        Session::flash('error','Ocurrio un error en la activación');
                  }
            }else{
                  Session::flash('error','El evento no pertenece al usuario');
            }     
            return Redirect::back();
      }
      
}
