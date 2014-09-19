<?php

use Sph\Storage\Negocio\NegocioRepository as Negocio;
use Sph\Storage\Negocio_Especial\NegocioEspecialRepository as Especial;
use Sph\Storage\Imagen\ImagenRepository as Imagen;

class clientesNegociosEspecialesController extends \BaseController
{

      protected $negocio;
      protected $especial;
      protected $imagen;

      public function __construct(Negocio $negocio, Especial $especial, Imagen $imagen)
      {
            parent::__construct();
            $this->negocio = $negocio;
            $this->especial = $especial;
            $this->imagen = $imagen;
            View::share('section', 'Negocio');
      }

      /**
       * Display a listing of the resource.
       * GET /clientesnegociosespeciales
       *
       * @return Response
       */
      public function index($id)
      {
            $negocio = $this->negocio->find($id);
            $imagenes = $negocio->especial->imagenes;
            return View::make('clientes.negocios_especiales.index')->with(array('imagenes' => $imagenes, 'negocio_id' => $id));
      }

      /**
       * Show the form for creating a new resource.
       * GET /clientesnegociosespeciales/create
       *
       * @return Response
       */
      public function create()
      {
            Input::get('negocio_id');
            return View::make('clientes.negocios_especiales.create')->with('negocio_id', Input::get('negocio_id'));
      }

      /**
       * Store a newly created resource in storage.
       * POST /clientesnegociosespeciales
       *
       * @return Response
       */
      public function store()
      {
            $negocio = $this->negocio->find(Input::get('negocio_id'));
            $total = count($negocio->especial->imagenes);
            if ($negocio)
            {
                  if ($total < 10)
                  {
                        $input = array('imagen' => Input::File('imagen'));
                        $validatorImagen = new Sph\Services\Validators\Imagen($input, 'save');

                        if ($validatorImagen->passes())
                        {

                              $especial_model = Input::all();

                              if ($input['imagen'])
                              {
                                    //Obtener datos de la imagen
                                    $path = strval(Auth::user()->id) . '/';
                                    $nombre = Auth::user()->userable->id . sha1(time()) . '.' . $input['imagen']->getClientOriginalExtension();
                                    $especial_model = array_add($especial_model, 'path', $path);
                                    $especial_model = array_add($especial_model, 'nombre_imagen', $nombre);
                              }
                              $especial = $this->especial->create(Input::get('negocio_id'), $especial_model);
                              if (isset($especial))
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

                                    Session::flash('message', 'Imagen guardada');
                                    return Redirect::route('clientes_negocios_especiales_index.get', array('id' => Input::get('negocio_id')));
                              }
                        }

                        return Redirect::back()->withErrors($validatorImagen->getErrors())->withInput();
                  }
                  else
                  {
                        Session::flash('error', 'Ya no se pueden agregar más imagenes');
                  }
            }
            else
            {
                  Session::flash('error', 'Seleccione un negocio al que agregar los datos');
            }


            return Redirect::route('clientes_negocios_especiales_index.get', array('id' => Input::get('negocio_id')));
      }

      /**
       * Display the specified resource.
       * GET /clientesnegociosespeciales/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            
      }

      /**
       * Show the form for editing the specified resource.
       * GET /clientesnegociosespeciales/{id}/edit
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $imagen = $this->imagen->find($id);
            return View::make('clientes.negocios_especiales.edit')->with(array('imagen' => $imagen, 'negocio_id' => Input::get('negocio_id')));
      }

      /**
       * Update the specified resource in storage.
       * PUT /clientesnegociosespeciales/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $imagen = $this->imagen->find($id);

            if ($imagen)
            {

                  $input = array('imagen' => Input::File('imagen'));
                  $validatorImagen = new Sph\Services\Validators\Imagen($input, 'update');

                  if ($validatorImagen->passes())
                  {
                        $especial_model = Input::all();

                        $especial = $this->especial->update($id, $especial_model);
                        if (isset($especial))
                        {
                              if ($input['imagen'])
                              {
                                    //Guardar la imagen; 
                                    $path = Config::get('params.usrimg') . $especial->path;
                                    try
                                    {
                                          $input['imagen']->move($path, $especial->nombre);
                                    } catch (Exception $e)
                                    {
                                          Log::error('MiembrosController.edit: ' . $e . get_message());
                                    }
                              }

                              Session::flash('message', 'Imagen guardada');
                              return Redirect::route('clientes_negocios_especiales_index.get', array('id' => Input::get('negocio_id')));
                        }
                  }
            }
            else
            {
                  Session::flash('error', 'Seleccione una imagen para modificar');
            }


            return Redirect::route('clientes_negocios_especiales_index.get', array('id' => Input::get('negocio_id')))->withErrors($validatorImagen->getErrors())->withInput();
      }

      /**
       * Remove the specified resource from storage.
       * DELETE /clientesnegociosespeciales/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            if ($this->imagen->delete($id))
            {
                  Session::flash('message', 'Imagen eliminada con exito');
            }
            else
            {
                  Session::flash('error', 'No se pudo eliminar la imagen');
            }
            return Redirect::route('clientes_negocios_especiales_index.get', array('id' => Input::get('negocio_id')));
      }

}
