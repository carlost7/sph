<?php

use Sph\Storage\Promocion\PromocionRepository as Promocion;
use Sph\Storage\Pago\PagoRepository as Pago;
use Carbon\Carbon;

class ClientsPromocionesController extends \BaseController
{

      protected $promocion;
      protected $pago;

      public function __construct(Promocion $promocion, Pago $pago)
      {
            $this->promocion = $promocion;
            $this->pago = $pago;
      }

      /**
       * Display a listing of promociones
       *
       * @return Response
       */
      public function index()
      {
            $promociones = Auth::user()->userable->promociones;
            return View::make('clients.promociones.index')->with("promociones", $promociones);
      }

      /**
       * Show the form for creating a new negocio
       *
       * @return Response
       */
      public function create()
      {
            return View::make('clients.promociones.create');
      }

      /**
       * Store a newly created negocio in storage.
       *
       * @return Response
       */
      public function store()
      {
            $validatorPromocion = new Sph\Services\Validators\Promocion(Input::all(), 'save');

            if ($validatorPromocion->passes())
            {
                  $promocion_model = Input::all();
                  $promocion_model = array_add($promocion_model, 'client', Auth::user()->userable);
                  $promocion_model = array_add($promocion_model, 'publicar', false);
                  $promocion = $this->promocion->create($promocion_model);
                  if (isset($promocion))
                  {
                        $pago_model = array(
                            'nombre' => 'Publicación de promoción',
                            'descripcion' => Input::get('nombre'),
                            'monto' => 100.00,
                            'client' => Auth::user()->userable,
                        );
                        $pago = $this->pago->create($pago_model);
                        if (isset($pago))
                        {
                              if($this->promocion->agregar_pago($promocion, $pago)){
                                    Session::flash('message', 'Promoción agregada con éxito');
                                    return Redirect::route('clientes_promociones.index');                                    
                              }
                        }
                        Session::flash('error', 'Error al agregar el pago');
                  }
                  else
                  {
                        Session::flash('error', 'Error al agregar la promoción');
                  }
            }
            return Redirect::back()->withErrors($validatorPromocion->getErrors())->withInput();
      }

      /**
       * Display the specified negocio.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $promocion = $this->promocion->find($id);
            return View::make('clients.promociones.show')->with('promocion', $promocion);
      }

      /**
       * Show the form for editing the specified negocio.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $promocion = $this->promocion->find($id);

            return View::make('clients.promociones.edit')->with('promocion', $promocion);
      }

      /**
       * Update the specified negocio in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $validatorPromocion = new Sph\Services\Validators\Promocion(Input::all(), 'update');

            if ($validatorPromocion->passes())
            {
                  $promocion_model = Input::all();

                  $promocion = $this->promocion->update($id, $promocion_model);
                  if (isset($promocion))
                  {
                        Session::flash('message', 'Promoción editada con éxito');
                        return Redirect::route('clientes_promociones.index');
                  }
                  else
                  {
                        Session::flash('error', 'Error al agregar la promoción');
                  }
            }
            return Redirect::back()->withErrors($validatorPromocion->getErrors())->withInput();
      }

      /**
       * Remove the specified negocio from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            if ($this->promocion->delete($id))
            {
                  Session::flash('message', 'Promocion eliminada');
            }
            else
            {
                  Session::flash('error', 'No se pudo eliminar la promoción');
            }
            return Redirect::route('clientes_promociones.index');
      }

}
