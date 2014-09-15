<?php

use Sph\Storage\Categoria\CategoriaRepository as Categoria;
use Sph\Storage\Subcategoria\SubcategoriaRepository as Subcategoria;
use Sph\Storage\Estado\EstadoRepository as Estado;
use Sph\Storage\Zona\ZonaRepository as Zona;

class AdminCatalogoController extends \BaseController
{

      protected $categoria;
      protected $subcategoria;
      protected $estado;
      protected $zona;

      public function __construct(Categoria $categoria, Subcategoria $subcat, Estado $estado, Zona $zona)
      {
            parent::__construct();
            $this->categoria = $categoria;
            $this->subcategoria = $subcat;
            $this->estado = $estado;
            $this->zona = $zona;            
      }

      /**
       * Display a listing of the resource.
       * GET /adminbuscador
       *
       * @return Response
       */
      public function index()
      {
            $categorias = $this->categoria->all();
            $subcategorias = $this->subcategoria->all();
            $estados = $this->estado->all();
            $zonas = $this->zona->all();

            return View::make('administradores.catalogo.index')->with(array('categorias' => $categorias,
                        'estados' => $estados,
            ));
      }

      /**
       * Show the form for creating a new resource.
       * GET /adminbuscador/create
       *
       * @return Response
       */
      public function create()
      {
            $categorias = $this->categoria->all();
            $estados = $this->estado->all();

            return View::make('administradores.catalogo.create')->with(array('categorias' => $categorias, 'estados' => $estados));
      }

      /**
       * Store a newly created resource in storage.
       * POST /adminbuscador
       *
       * @return Response
       */
      public function store()
      {
            if (Input::get('categoria'))
            {
                  $this->categoria->create(Input::all());
            }
            if (Input::get('subcategoria'))
            {
                  $this->subcategoria->create(Input::all());
            }
            if (Input::get('estado'))
            {
                  $this->estado->create(Input::all());
            }
            if (Input::get('zona'))
            {
                  $this->zona->create(Input::all());
            }

            Session::flash('message','Objeto agregado con éxito');
            
            return Redirect::back()->withInput();
      }

      /**
       * Display the specified resource.
       * GET /adminbuscador/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            
      }

      /**
       * Show the form for editing the specified resource.
       * GET /adminbuscador/{id}/edit
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $tipo = strtolower(Input::get('tipo'));

            if (isset($tipo))
            {
                  $categorias = $this->categoria->all();
                  $estados = $this->estado->all();
                  $objeto = $this->$tipo->find($id);
                  return View::make('administradores.catalogo.edit')->with(array('tipo' => $tipo, 'objeto' => $objeto, 'categorias' => $categorias, 'estados' => $estados));
            }
            else
            {
                  Session::flash('error', 'Elige un elemento para editar');
            }
      }

      /**
       * Update the specified resource in storage.
       * PUT /adminbuscador/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $tipo = Input::get('tipo');
            if (isset($tipo))
            {
                  $object_model = Input::All();

                  if ($tipo == 'subcategoria')
                  {
                        $object_model = array_add($object_model, 'padre', Input::get('categoria_id'));
                  }
                  elseif ($tipo == 'zona')
                  {
                        $object_model = array_add($object_model, 'padre', Input::get('estado_id'));
                  }

                  if ($this->$tipo->update($id, $object_model))
                  {
                        Session::flash('message', 'Objeto editado con exito');
                        return Redirect::route('administrador_catalogo.index');
                  }
                  else
                  {
                        Session::flash('error', 'Error al editar el objeto');
                  }
            }
            else
            {
                  Session::flash('error', 'No existe el tipo');
            }

            return Redirect::back()->withInput();
      }

      /**
       * Remove the specified resource from storage.
       * DELETE /adminbuscador/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            $tipo = strtolower(Input::get('tipo'));

            if (isset($tipo))
            {
                  if ($this->$tipo->delete($id))
                  {
                        Session::flash('message', $tipo . ' eliminado con exito');
                        return Redirect::back();
                  }
                  else
                  {
                        Session::flash('error', 'Error al eliminar');
                        return Redirect::back();
                  }
            }
      }

}
