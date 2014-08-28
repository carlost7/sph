<?php

use Sph\Storage\Evento\EventoRepository as Evento;
use Sph\Storage\Evento_Especial\EventoEspecialRepository as Especial;
use Sph\Storage\Imagen\ImagenRepository as Imagen;

class clientesEventosEspecialesController extends \BaseController
{

      protected $evento;
      protected $especial;
      protected $imagen;

      public function __construct(Evento $evento, Especial $especial, Imagen $imagen)
      {
            $this->evento = $evento;
            $this->especial = $especial;
            $this->imagen = $imagen;
      }

      /**
       * Display a listing of the resource.
       * GET /clienteseventosespeciales
       *
       * @return Response
       */
      public function index($id)
      {
            $evento = $this->evento->find($id);
            $imagenes = $evento->especial->imagenes;
            return View::make('clientes.eventos_especiales.index')->with(array('imagenes' => $imagenes, 'evento_id' => $id));
      }

      /**
       * Show the form for creating a new resource.
       * GET /clienteseventosespeciales/create
       *
       * @return Response
       */
      public function create()
      {
            Input::get('evento_id');
            return View::make('clientes.eventos_especiales.create')->with('evento_id', Input::get('evento_id'));
      }

      /**
       * Store a newly created resource in storage.
       * POST /clienteseventosespeciales
       *
       * @return Response
       */
      public function store()
      {
            $evento = $this->evento->find(Input::get('evento_id'));
            $total = count($evento->especial->imagenes);
            if ($evento)
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
                                    $path = strval(Auth::user()->userable->id) . '/';
                                    $nombre = Auth::user()->userable->id . sha1(time()) . '.' . $input['imagen']->getClientOriginalExtension();
                                    $especial_model = array_add($especial_model, 'path', $path);
                                    $especial_model = array_add($especial_model, 'nombre_imagen', $nombre);
                              }
                              $especial = $this->especial->create(Input::get('evento_id'), $especial_model);
                              if (isset($especial))
                              {
                                    if ($input['imagen'])
                                    {
                                          //Guardar la imagen; 
                                          $path = Config::get('params.usrimg') . $path;
                                          $input['imagen']->move($path, $nombre);
                                    }

                                    Session::flash('message', 'Imagen guardada');
                                    return Redirect::route('clientes_eventos_especiales_index.get', array('id' => Input::get('evento_id')));
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
                  Session::flash('error', 'Seleccione un evento al que agregar los datos');
            }


            return Redirect::route('clientes_eventos_especiales_index.get', array('id' => Input::get('evento_id')));
      }

      /**
       * Display the specified resource.
       * GET /clienteseventosespeciales/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            
      }

      /**
       * Show the form for editing the specified resource.
       * GET /clienteseventosespeciales/{id}/edit
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $imagen = $this->imagen->find($id);
            return View::make('clientes.eventos_especiales.edit')->with(array('imagen' => $imagen, 'evento_id' => Input::get('evento_id')));
      }

      /**
       * Update the specified resource in storage.
       * PUT /clienteseventosespeciales/{id}
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
                                    $input['imagen']->move($path, $especial->nombre);
                              }

                              Session::flash('message', 'Imagen guardada');
                              return Redirect::route('clientes_eventos_especiales_index.get', array('id' => Input::get('evento_id')));
                        }
                  }
            }
            else
            {
                  Session::flash('error', 'Seleccione una imagen para modificar');
            }


            return Redirect::route('clientes_eventos_especiales_index.get', array('id' => Input::get('evento_id')))->withErrors($validatorImagen->getErrors())->withInput();
      }

      /**
       * Remove the specified resource from storage.
       * DELETE /clienteseventosespeciales/{id}
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
            return Redirect::route('clientes_eventos_especiales_index.get', array('id' => Input::get('evento_id')));
            
      }

}
