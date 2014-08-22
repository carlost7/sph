<?php

use Sph\Storage\Negocio\NegocioRepository as Negocio;
use Sph\Storage\Categoria\CategoriaRepository as Categoria;
use Sph\Storage\Subcategoria\SubcategoriaRepository as Subcategoria;
use Sph\Storage\Zona\ZonaRepository as Zona;
use Sph\Storage\Estado\EstadoRepository as Estado;
use Sph\Storage\MasinfoNegocio\MasinfoNegocioRepository as Masinfo;
use Sph\Storage\HorarioNegocio\HorarioNegocioRepository as Horario;
use Sph\Storage\Imagen\ImagenRepository as Imagen;
use Sph\Storage\Negocio_Especial\NegocioEspecialRepository as Especial;
use Sph\Storage\Pago\PagoRepository as Pago;

class clientesNegociosController extends \BaseController
{

      protected $categoria;
      protected $estado;
      protected $horario;
      protected $imagen;
      protected $mas_info;
      protected $negocio;
      protected $especial;
      protected $pago;
      protected $subcategoria;
      protected $zona;

      public function __construct(Categoria $categoria, Estado $estado, Horario $horario, Imagen $imagen, Masinfo $masinfo, Negocio $negocio, Especial $especial, Pago $pago, Subcategoria $subcategoria, Zona $zona)
      {
            $this->categoria = $categoria;
            $this->estado = $estado;
            $this->horario = $horario;
            $this->imagen = $imagen;
            $this->mas_info = $masinfo;
            $this->negocio = $negocio;
            $this->especial = $especial;
            $this->pago = $pago;
            $this->subcategoria = $subcategoria;
            $this->zona = $zona;
      }

      /**
       * Display a listing of negocios
       *
       * @return Response
       */
      public function index()
      {
            $negocios = Auth::user()->userable->negocios;
            return View::make('clientes.negocios.index')->with("negocios", $negocios);
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
            return View::make('clientes.negocios.create')->with(array('categorias' => $categorias, 'estados' => $estados));
      }

      /**
       * Store a newly created negocio in storage.
       *
       * @return Response
       */
      public function store()
      {

            $validatorNegocio = new Sph\Services\Validators\Negocio(Input::all(), 'save');
            $validatorHorario = new Sph\Services\Validators\HorarioNegocio(Input::all(), 'save');
            $validatorMasinfo = new Sph\Services\Validators\MasinfoNegocio(Input::all(), 'save');
            $validatorCatalogo = new Sph\Services\Validators\Catalogo(Input::all(), 'save');
            $input = array('imagen' => Input::File('imagen'));
            $validatorImagen = new Sph\Services\Validators\Imagen($input, 'save');

            if ($validatorNegocio->passes() & $validatorHorario->passes() & $validatorMasinfo->passes() & $validatorCatalogo->passes())
            {
                  $negocio_model = Input::all();
                  $negocio_model = array_add($negocio_model, 'client', Auth::user()->userable);
                  $negocio_model = array_add($negocio_model, 'publicar', false);
                  //Obtener datos de la imagen
                  $path = strval(Auth::user()->userable->id) . '/';
                  $nombre = strval(Auth::user()->userable->total_images + 1) . '.' . $input['imagen']->getClientOriginalExtension();
                  $negocio_model = array_add($negocio_model, 'path', $path);
                  $negocio_model = array_add($negocio_model, 'nombre_imagen', $nombre);

                  $negocio = $this->negocio->create($negocio_model);

                  if (isset($negocio))
                  {
                        //Guardar la imagen; 
                        $path = Config::get('params.usrimg') . $path;
                        $input['imagen']->move($path, $nombre);

                        //Crear Pago de servicios
                        $pago_model = array(
                            'nombre' => 'Publicación de Negocio',
                            'descripcion' => $negocio->nombre,
                            'monto' => Config::get('costos.negocio'),
                            'client' => Auth::user()->userable,
                        );
                        $pago = $this->pago->create($pago_model);
                        if (isset($pago))
                        {
                              if ($this->negocio->agregar_pago($negocio, $pago))
                              {
                                    Session::flash('message', 'Negocio agregado con éxito');
                                    return Redirect::route('clientes_negocios.index');
                              }
                        }
                  }
                  else
                  {
                        Session::flash('error', 'Error al agregar el negocio');
                  }
            }

            //Mensaje de error de validaciones
            $negocio_messages = ($validatorNegocio->getErrors() != null) ? $validatorNegocio->getErrors()->all() : array();
            $horario_messages = ($validatorHorario->getErrors() != null) ? $validatorHorario->getErrors()->all() : array();
            $masinfo_messages = ($validatorMasinfo->getErrors() != null) ? $validatorMasinfo->getErrors()->all() : array();
            $catalogo_messages = ($validatorCatalogo->getErrors() != null) ? $validatorCatalogo->getErrors()->all() : array();
            $imagen_messages = ($validatorImagen->getErrors() != null) ? $validatorImagen->getErrors()->all() : array();

            $validationMessages = array_merge_recursive(
                    $negocio_messages, $horario_messages, $masinfo_messages, $catalogo_messages, $imagen_messages
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
            $negocio = $this->negocio->find($id);
            return View::make('clientes.negocios.show')->with('negocio', $negocio);
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
            $categorias = $this->categoria->all();
            $estados = $this->estado->all();
            return View::make('clientes.negocios.edit')->with(array('negocio' => $negocio, 'categorias' => $categorias, 'estados' => $estados));
      }

      /**
       * Update the specified negocio in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $validatorNegocio = new Sph\Services\Validators\Negocio(Input::all(), 'update');
            $validatorHorario = new Sph\Services\Validators\HorarioNegocio(Input::all(), 'update');
            $validatorMasinfo = new Sph\Services\Validators\MasinfoNegocio(Input::all(), 'update');
            $validatorCatalogo = new Sph\Services\Validators\Catalogo(Input::all(), 'update');
            $input = array('imagen' => Input::File('imagen'));
            $validatorImagen = new Sph\Services\Validators\Imagen($input, 'update');

            if ($validatorNegocio->passes() & $validatorHorario->passes() & $validatorMasinfo->passes() & $validatorCatalogo->passes())
            {
                  $negocio = $this->negocio->find($id);

                  $negocio_model = Input::all();
                  $negocio_model = array_add($negocio_model, 'client', Auth::user()->userable);
                  $negocio_model = array_add($negocio_model, 'publicar', false);

                  //Obtener datos de la imagen

                  $path = $negocio->imagen->path;
                  $nombre = $negocio->imagen->nombre;

                  $negocio_model = array_add($negocio_model, 'path', $path);
                  $negocio_model = array_add($negocio_model, 'nombre_imagen', $nombre);

                  $negocio = $this->negocio->update($id, $negocio_model);

                  if (isset($negocio))
                  {
                        if ($input['imagen'])
                        {
                              $input['imagen']->move($path, $nombre);
                        }
                        Session::flash('message', 'Negocio modificado con éxito');
                        return Redirect::route('clientes_negocios.index');
                  }
                  else
                  {
                        Session::flash('error', 'Error al agregar el negocio');
                  }
            }

            //Mensaje de error de validaciones
            $negocio_messages = ($validatorNegocio->getErrors() != null) ? $validatorNegocio->getErrors()->all() : array();
            $horario_messages = ($validatorHorario->getErrors() != null) ? $validatorHorario->getErrors()->all() : array();
            $masinfo_messages = ($validatorMasinfo->getErrors() != null) ? $validatorMasinfo->getErrors()->all() : array();
            $catalogo_messages = ($validatorCatalogo->getErrors() != null) ? $validatorCatalogo->getErrors()->all() : array();
            $imagen_messages = ($validatorImagen->getErrors() != null) ? $validatorImagen->getErrors()->all() : array();

            $validationMessages = array_merge_recursive(
                    $negocio_messages, $horario_messages, $masinfo_messages, $catalogo_messages, $imagen_messages
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
            if ($negocio->client->id == Auth::user()->userable->id)
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
