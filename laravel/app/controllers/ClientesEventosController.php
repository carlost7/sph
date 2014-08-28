<?php

use Sph\Storage\Evento\EventoRepository as Evento;
use Sph\Storage\Categoria\CategoriaRepository as Categoria;
use Sph\Storage\Subcategoria\SubcategoriaRepository as Subcategoria;
use Sph\Storage\Zona\ZonaRepository as Zona;
use Sph\Storage\Estado\EstadoRepository as Estado;
use Sph\Storage\MasinfoEvento\MasinfoEventoRepository as Masinfo;
use Sph\Storage\Pago\PagoRepository as Pago;
use Sph\Storage\Imagen\ImagenRepository as Imagen;
use Sph\Storage\Evento_Especial\EventoEspecialRepository as Especial;

class clientesEventosController extends \BaseController
{

      protected $categoria;
      protected $estado;
      protected $imagen;
      protected $mas_info;
      protected $evento;
      protected $especial;
      protected $pago;
      protected $subcategoria;
      protected $zona;

      public function __construct(Categoria $categoria, Estado $estado, Imagen $imagen, Masinfo $masinfo, Evento $evento, Especial $especial, Pago $pago, Subcategoria $subcategoria, Zona $zona)
      {
            $this->categoria = $categoria;
            $this->estado = $estado;
            $this->imagen = $imagen;
            $this->mas_info = $masinfo;
            $this->evento = $evento;
            $this->especial = $especial;
            $this->pago = $pago;
            $this->subcategoria = $subcategoria;
            $this->zona = $zona;
      }

      /**
       * Display a listing of eventos
       *
       * @return Response
       */
      public function index()
      {
            $eventos = Auth::user()->userable->eventos;
            return View::make('clientes.eventos.index')->with("eventos", $eventos);
      }

      /**
       * Show the form for creating a new negocio
       *
       * @return Response
       */
      public function create()
      {
            $categorias = $this->categoria->all();
            $estados = $this->estado->all();
            return View::make('clientes.eventos.create')->with(array('categorias' => $categorias, 'estados' => $estados));
      }

      /**
       * Store a newly created negocio in storage.
       *
       * @return Response
       */
      public function store()
      {
            $validatorEvento = new Sph\Services\Validators\Evento(Input::all(), 'save');
            $validatorMasinfo = new Sph\Services\Validators\MasinfoEvento(Input::all(), 'save');
            $validatorCatalogo = new Sph\Services\Validators\Catalogo(Input::all(), 'save');
            $input = array('imagen' => Input::File('imagen'));
            $validatorImagen = new Sph\Services\Validators\Imagen($input, 'save');

            if ($validatorEvento->passes() & $validatorMasinfo->passes() & $validatorCatalogo->passes() & $validatorImagen->passes())
            {
                  $evento_model = Input::all();
                  $evento_model = array_add($evento_model, 'cliente', Auth::user()->userable);
                  $evento_model = array_add($evento_model, 'publicar', false);

                  if ($input['imagen'])
                  {
                        //Obtener datos de la imagen
                        $path = strval(Auth::user()->userable->id) . '/';
                        $nombre = Auth::user()->userable->id . sha1(time()) . '.' . $input['imagen']->getClientOriginalExtension();
                        $evento_model = array_add($evento_model, 'path', $path);
                        $evento_model = array_add($evento_model, 'nombre_imagen', $nombre);
                  }


                  $evento = $this->evento->create($evento_model);
                  if (isset($evento))
                  {
                        if ($input['imagen'])
                        {
                              //Guardar la imagen; 
                              $path = Config::get('params.usrimg') . $path;
                              $input['imagen']->move($path, $nombre);
                        }

                        //Crear Pago de servicios
                        $pago_model = array(
                            'nombre' => 'Publicación de Evento',
                            'descripcion' => $evento->nombre,
                            'monto' => Config::get('costos.evento'),
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
            //Mensaje de error de validaciones
            $evento_messages = ($validatorEvento->getErrors() != null) ? $validatorEvento->getErrors()->all() : array();
            $masinfo_messages = ($validatorMasinfo->getErrors() != null) ? $validatorMasinfo->getErrors()->all() : array();
            $catalogo_messages = ($validatorCatalogo->getErrors() != null) ? $validatorCatalogo->getErrors()->all() : array();
            $imagen_messages = ($validatorImagen->getErrors() != null) ? $validatorImagen->getErrors()->all() : array();

            $validationMessages = array_merge_recursive(
                    $evento_messages, $masinfo_messages, $catalogo_messages, $imagen_messages
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
            $evento = $this->evento->find($id);
            return View::make('clientes.eventos.show')->with('evento', $evento);
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

            $categorias = $this->categoria->all();
            $estados = $this->estado->all();
            $mapa = null;
            
            if ( count($evento->especial) && isset($evento->especial->mapa) )
            {
                  
                  $config = array();
                  $config['center'] = $evento->especial->mapa;
                  $config['zoom'] = '13';
                  Gmaps::initialize($config);

                  $marker = array();
                  $marker['position'] = $evento->especial->mapa;
                  $marker['draggable'] = true;
                  $marker['ondragend'] = 'edit_map(event);';
                  Gmaps::add_marker($marker);

                  $mapa = Gmaps::create_map();
            }
            else
            {
                  $config = array();
                  $config['center'] = '19.417, -99.169';
                  $config['zoom'] = '13';
                  $config['onclick'] = 'save_map(event);';
                  Gmaps::initialize($config);

                  $marker = array();
                  Gmaps::add_marker($marker);
                  $mapa = Gmaps::create_map();
            }


            return View::make('clientes.eventos.edit')->with(array('evento' => $evento, 'categorias' => $categorias, 'estados' => $estados, 'mapa' => $mapa));
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
            $validatorMasinfo = new Sph\Services\Validators\MasinfoEvento(Input::all(), 'update');
            $validatorEspecial = new Sph\Services\Validators\Evento_especial(Input::all(), 'update');
            $validatorCatalogo = new Sph\Services\Validators\Catalogo(Input::all(), 'update');
            $input = array('imagen' => Input::File('imagen'));
            $validatorImagen = new Sph\Services\Validators\Imagen($input, 'update');

            if ($validatorEvento->passes() & $validatorMasinfo->passes() & $validatorCatalogo->passes() & $validatorEspecial->passes())
            {
                  $evento = $this->evento->find($id);

                  $evento_model = Input::all();

                  if ($input['imagen'] && !$evento->imagen)
                  {
                        //Obtener datos de la imagen
                        $path = strval(Auth::user()->userable->id) . '/';
                        $nombre = Auth::user()->userable->id . sha1(time()) . '.' . $input['imagen']->getClientOriginalExtension();
                        $evento_model = array_add($evento_model, 'path', $path);
                        $evento_model = array_add($evento_model, 'nombre_imagen', $nombre);
                  }

                  $evento = $this->evento->update($id, $evento_model);

                  if (isset($evento))
                  {
                        if ($input['imagen'])
                        {
                              $input['imagen']->move(Config::get('params.usrimg') . $evento->imagen->path, $evento->imagen->nombre);
                        }
                        Session::flash('message', 'Evento modificado con éxito');
                        
                        if(Input::get('add_images')){
                              return Redirect::route('clientes_eventos_especiales_index.get',array('id'=>$evento->id));
                        }else{
                              return Redirect::route('clientes_eventos.index');
                        }
                        
                  }
                  else
                  {
                        Session::flash('error', 'Error al agregar el evento');
                  }
            }

            $evento_messages = ($validatorEvento->getErrors() != null) ? $validatorEventoEspecial->getErrors()->all() : array();
            $masinfo_messages = ($validatorMasinfo->getErrors() != null) ? $validatorMasinfo->getErrors()->all() : array();
            $especial_messages = ($validatorEspecial->getErrors() != null) ? $validatorEspecial->getErrors()->all() : array();
            $catalogo_messages = ($validatorCatalogo->getErrors() != null) ? $validatorCatalogo->getErrors()->all() : array();
            $imagen_messages = ($validatorImagen->getErrors() != null) ? $validatorImagen->getErrors()->all() : array();

            $validationMessages = array_merge_recursive(
                    $evento_messages, $masinfo_messages, $catalogo_messages, $imagen_messages, $especial_messages
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
            if ($evento->client->id == Auth::user()->userable->id)
            {
                  if ($this->evento->activar($id))
                  {
                        Session::flash('message', 'Activación correcta');
                        return Redirect::route('clientes_eventos.index');
                  }
                  else
                  {
                        Session::flash('error', 'Ocurrio un error en la activación');
                  }
            }
            else
            {
                  Session::flash('error', 'El evento no pertenece al usuario');
            }
            return Redirect::back();
      }

}
