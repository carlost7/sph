<?php

use Sph\Storage\Promocion\PromocionRepository as Promocion;
use Sph\Storage\Pago\PagoRepository as Pago;
use Carbon\Carbon;

class clientesPromocionesController extends \BaseController
{

      protected $promocion;
      protected $pago;

      public function __construct(Promocion $promocion, Pago $pago)
      {
            parent::__construct();
            $this->promocion = $promocion;
            $this->pago = $pago;
            View::share('section', 'Promocion');
      }

      /**
       * Display a listing of promociones
       *
       * @return Response
       */
      public function index()
      {
            $promociones = Auth::user()->userable->promociones;

            return View::make('clientes.promociones.index')->with("promociones", $promociones);
      }

      /**
       * Show the form for creating a new negocio
       *
       * @return Response
       */
      public function create()
      {
            $negocios = Auth::user()->userable->negocios;

            return View::make('clientes.promociones.create')->with('negocios', $negocios);
      }

      /**
       * Store a newly created negocio in storage.
       *
       * @return Response
       */
      public function store()
      {
            $validatorPromocion = new Sph\Services\Validators\Promocion(Input::all(), 'save');
            $input = array('imagen' => Input::File('imagen'));
            $validatorImagen = new Sph\Services\Validators\Imagen(Input::all(), 'save');

            if ($validatorPromocion->passes() & $validatorImagen->passes())
            {
                  $promocion_model = Input::all();
                  $promocion_model = array_add($promocion_model, 'publicar', false);
                  if ($input['imagen'])
                  {
                        //Obtener datos de la imagen
                        $path = strval(Auth::user()->id) . '/';
                        $nombre = Auth::user()->userable->id . sha1(time()) . '.' . $input['imagen']->getClientOriginalExtension();
                        $promocion_model = array_add($promocion_model, 'path', $path);
                        $promocion_model = array_add($promocion_model, 'nombre_imagen', $nombre);
                  }
                  $promocion = $this->promocion->create($promocion_model);
                  if (isset($promocion))
                  {

                        if ($input['imagen'])
                        {
                              //Guardar la imagen; 
                              $path = Config::get('params.usrimg') . $path;
                              try
                              {
                                    $input['imagen']->move($path, $nombre);
                              } catch (Exception $e)
                              {
                                    Log::error('MiembrosController.edit: ' . $e . get_message());
                              }
                        }

                        $pago_model = array(
                            'nombre' => 'Publicación de promoción',
                            'descripcion' => Input::get('nombre'),
                            'monto' => Config::get('costos.promocion'),
                            'client' => Auth::user()->userable,
                        );
                        $pago = $this->pago->create($pago_model);
                        if (isset($pago))
                        {
                              if ($this->promocion->agregar_pago($promocion, $pago))
                              {
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

            $promociones_messages = ($validatorPromocion->getErrors() != null) ? $validatorPromocion->getErrors()->all() : array();
            $imagen_messages = ($validatorImagen->getErrors() != null) ? $validatorImagen->getErrors()->all() : array();

            $validationMessages = array_merge_recursive(
                    $promociones_messages, $imagen_messages
            );

            return Redirect::back()->withErrors($validationMessages)->withInput();
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
            return View::make('clientes.promociones.show')->with('promocion', $promocion);
      }

      /**
       * Show the form for editing the specified negocio.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $negocios = Auth::user()->userable->negocios;
            $promocion = $this->promocion->find($id);

            return View::make('clientes.promociones.edit')->with(array('promocion' => $promocion, 'negocios' => $negocios));
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
            $input = array('imagen' => Input::File('imagen'));
            $validatorImagen = new Sph\Services\Validators\Imagen(Input::all(), 'update');

            if ($validatorPromocion->passes() & $validatorImagen->passes())
            {

                  $promocion = $this->promocion->find($id);

                  $promocion_model = Input::all();

                  if ($input['imagen'] && !$promocion->imagen)
                  {
                        //Obtener datos de la imagen
                        $path = strval(Auth::user()->id) . '/';
                        $nombre = Auth::user()->userable->id . sha1(time()) . '.' . $input['imagen']->getClientOriginalExtension();
                        $promocion_model = array_add($promocion_model, 'path', $path);
                        $promocion_model = array_add($promocion_model, 'nombre_imagen', $nombre);
                  }

                  $promocion = $this->promocion->update($id, $promocion_model);
                  if (isset($promocion))
                  {
                        if ($input['imagen'])
                        {
                              //Guardar la imagen; 
                              $path = Config::get('params.usrimg') . $promocion->imagen->path;
                              $nombre = $promocion->imagen->nombre;
                              try
                              {
                                    $input['imagen']->move($path, $nombre);
                              } catch (Exception $e)
                              {
                                    Log::error('MiembrosController.edit: ' . $e . get_message());
                              }
                        }

                        Session::flash('message', 'Promoción editada con éxito');
                        return Redirect::route('clientes_promociones.index');
                  }
                  else
                  {
                        Session::flash('error', 'Error al agregar la promoción');
                  }
            }
            $promocion_messages = ($validatorPromocion->getErrors() != null) ? $validatorPromocion->getErrors()->all() : array();
            $imagen_messages = ($validatorImagen->getErrors() != null) ? $validatorImagen->getErrors()->all() : array();

            $validationMessages = array_merge_recursive($promocion_messages, $imagen_messages);

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
