<?php


class clientesNegociosController extends \BaseController {

      public function __construct()
      {
            parent::__construct();
            View::share('section', 'Negocio');
      }

      /**
       * Display a listing of negocios
       *
       * @return Response
       */
      public function index()
      {
            $negocios = Auth::user()->userable->negocios;
            return View::make('clientes.negocios.index', compact('negocios'));
      }

      /**
       * Show the form for creating a new negocio
       *
       * @return Response
       */
      public function create()
      {
            $categorias = Categoria::all();
            $estados    = Estado::all();
            return View::make('clientes.negocios.create', compact('categorias', 'estados'));
      }

      /**
       * Store a newly created negocio in storage.
       *
       * @return Response
       */
      public function store()
      {

            /*
             * Buscamos los estados, zonas, categorias, y subcategorias
             */

            $estado       = Estado::find(Input::get('estado_id'));
            $zona         = (Input::get('zona_id')) ? Zona::find(Input::get('zona_id')) : null;
            $categoria    = Categoria::find(Input::get('categoria_id'));
            $subcategoria = (Input::get('subcategoria_id')) ? Subcategoria::find(5000) : null;

            if (!count($estado) || !count($categoria))
            {
                  Session::flash('error', "Debe elegir un Estado y una Categoría");
                  Redirect::back()->withInput()->withErrors();
            }

            $negocio = new Negocio;
            $masInfo = new MasInfoNegocio;
            $horario = new HorarioNegocio;

            $negocio->publicar = false;
            $negocio->estado()->associate($estado);
            if(isset($zona)) {
                  $negocio->zona()->associate($zona);
            }
            $negocio->categoria()->associate($categoria);
            if(isset($subcategoria)) {
                  $negocio->subcategoria()->associate($subcategoria);
            }
            $negocio->cliente()->associate(Auth::user()->userable);
            
            if (!$negocio->validate())
            {
                  return Redirect::back()->withInput()->withErrors($negocio->errors());
            }
            if (!$masInfo->validate())
            {
                  return Redirect::back()->withInput()->withErrors($masInfo->errors());
            }
            if (!$horario->validate())
            {
                  return Redirect::back()->withInput()->withErrors($horario->errors());
            }

            //Guardamos el negocio
            if ($negocio->save())
            {
                  
                  $negocio->masInfo()->save($masInfo);            
                  $negocio->horario()->save($horario);
                  
                  Session::flash('message', "Negocio creado con exito");
                  return Redirect::route('clientes_negocios.index');
            }
            return Redirect::back()->withInput()->withErrors($negocio->errors());
      }

      /**
       * Display the specified negocio.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $negocio = $this->negocio->find($id);
            if (Auth::user()->userable->id !== $negocio->cliente->id)
            {
                  Session::flash('error', 'El negocio no pertenece al usuario actual');
                  return Redirect::back();
            }


            $mapa = null;

            if (count($negocio->especial))
            {
                  $config           = array();
                  $config['center'] = $negocio->especial->mapa;
                  $config['zoom']   = '13';
                  Gmaps::initialize($config);

                  $marker             = array();
                  $marker['position'] = $negocio->especial->mapa;
                  Gmaps::add_marker($marker);
                  $mapa               = Gmaps::create_map();
            }

            return View::make('clientes.negocios.show')->with(array('negocio' => $negocio, 'mapa' => $mapa));
      }

      /**
       * Show the form for editing the specified negocio.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $negocio = $this->negocio->find($id);
            if (Auth::user()->userable->id !== $negocio->cliente->id)
            {
                  Session::flash('error', 'El negocio no pertenece al usuario actual');
                  return Redirect::back();
            }


            $categorias = $this->categoria->all();
            $estados    = $this->estado->all();
            $mapa       = null;

            $config = array();
            $marker = array();

            if (isset($negocio->especial->mapa))
            {
                  $config['center']    = $negocio->especial->mapa;
                  $marker['position']  = $negocio->especial->mapa;
                  $marker['draggable'] = true;
                  $marker['ondragend'] = 'edit_map(event);';
            }
            else
            {
                  $config['center']  = '19.417, -99.169';
                  $config['onclick'] = 'save_map(event);';
            }

            $config['zoom'] = '13';
            Gmaps::initialize($config);
            Gmaps::add_marker($marker);
            $mapa           = Gmaps::create_map();

            return View::make('clientes.negocios.edit')->with(array('negocio' => $negocio, 'categorias' => $categorias, 'estados' => $estados, 'mapa' => $mapa));
      }

      /**
       * Update the specified negocio in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $negocio = $this->negocio->find($id);
            if (Auth::user()->userable->id !== $negocio->cliente->id)
            {
                  Session::flash('error', 'El negocio no pertenece al usuario actual');
                  return Redirect::back();
            }

            $validatorNegocio  = new Sph\Services\Validators\Negocio(Input::all(), 'update');
            $validatorHorario  = new Sph\Services\Validators\HorarioNegocio(Input::all(), 'update');
            $validatorMasinfo  = new Sph\Services\Validators\MasinfoNegocio(Input::all(), 'update');
            $validatorEspecial = new Sph\Services\Validators\Negocio_especial(Input::all(), 'update');
            $validatorCatalogo = new Sph\Services\Validators\Catalogo(Input::all(), 'update');
            $input             = array('imagen' => Input::File('imagen'));
            $validatorImagen   = new Sph\Services\Validators\Imagen($input, 'update');

            if ($validatorNegocio->passes() & $validatorHorario->passes() & $validatorMasinfo->passes() & $validatorCatalogo->passes() & $validatorEspecial->passes())
            {
                  $negocio = $this->negocio->find($id);

                  $negocio_model = Input::all();

                  if ($input['imagen'] && !$negocio->imagen)
                  {
                        //Obtener datos de la imagen
                        $path          = strval(Auth::user()->id) . '/';
                        $nombre        = Auth::user()->userable->id . sha1(time()) . '.' . $input['imagen']->getClientOriginalExtension();
                        $negocio_model = array_add($negocio_model, 'path', $path);
                        $negocio_model = array_add($negocio_model, 'nombre_imagen', $nombre);
                  }

                  $negocio = $this->negocio->update($id, $negocio_model);

                  if (isset($negocio))
                  {
                        if ($input['imagen'])
                        {
                              try {
                                    $input['imagen']->move(Config::get('params.path_public_image') . $negocio->imagen->path, $negocio->imagen->nombre);
                              } catch (Exception $e) {
                                    Log::error('NegociosController.edit: ' . $e->getMessage());
                              }
                        }

                        Session::flash('message', 'Negocio modificado con éxito');
                        if (Input::get('add_images'))
                        {
                              return Redirect::route('clientes_negocios_especiales_index.get', array('id' => $negocio->id));
                        }
                        else
                        {
                              return Redirect::route('clientes_negocios.index');
                        }
                  }
                  else
                  {
                        Session::flash('error', 'Error al agregar el negocio');
                  }
            }

            //Mensaje de error de validaciones
            $negocio_messages  = ($validatorNegocio->getErrors() != null) ? $validatorNegocio->getErrors()->all() : array();
            $horario_messages  = ($validatorHorario->getErrors() != null) ? $validatorHorario->getErrors()->all() : array();
            $masinfo_messages  = ($validatorMasinfo->getErrors() != null) ? $validatorMasinfo->getErrors()->all() : array();
            $especial_messages = ($validatorEspecial->getErrors() != null) ? $validatorEspecial->getErrors()->all() : array();
            $catalogo_messages = ($validatorCatalogo->getErrors() != null) ? $validatorCatalogo->getErrors()->all() : array();
            $imagen_messages   = ($validatorImagen->getErrors() != null) ? $validatorImagen->getErrors()->all() : array();

            $validationMessages = array_merge_recursive(
                    $negocio_messages, $horario_messages, $masinfo_messages, $catalogo_messages, $imagen_messages, $especial_messages
            );

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
            $negocio = $this->negocio->find($id);
            if (Auth::user()->userable->id !== $negocio->cliente->id)
            {
                  Session::flash('error', 'El negocio no pertenece al usuario actual');
                  return Redirect::back();
            }

            if ($this->negocio->delete($id))
            {
                  Session::flash('message', 'Negocio eliminado');
            }
            else
            {
                  Session::flash('error', 'No se pudo eliminar el negocio');
            }
            return Redirect::route('clientes_negocios.index');
      }

      /*
       * Funcion que le permite al usuario activar su negocio nuevamente
       * 
       */

      public function activar($id)
      {
            $negocio = $this->negocio->find($id);
            if (Auth::user()->userable->id !== $negocio->cliente->id)
            {
                  Session::flash('error', 'El negocio no pertenece al usuario actual');
                  return Redirect::back();
            }

            $negocio = $this->negocio->find($id);
            if ($negocio->cliente->id == Auth::user()->userable->id)
            {
                  if ($this->negocio->activar($id))
                  {
                        Session::flash('message', 'Activación correcta');
                        return Redirect::route('clientes_negocios.index');
                  }
                  else
                  {
                        Session::flash('error', 'El negocio no pertenece al usuario');
                  }
            }
            else
            {
                  Session::flash('error', 'El negocio no pertenece al usuario');
            }
            return Redirect::back();
      }

}
