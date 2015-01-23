<?php

class AdminCatalogoController extends \BaseController {

      /**
       * Display a listing of the resource.
       * GET /adminbuscador
       *
       * @return Response
       */
      public function index()
      {
            $categorias    = Categoria::all();
            $subcategorias = Subcategoria::all();
            $estados       = Estado::all();
            $zonas         = Zona::all();

            return View::make('administradores.catalogo.index', compact('categorias', 'subcategorias', 'zonas', 'estados'));
      }

      /**
       * Show the form for creating a new resource.
       * GET /adminbuscador/create
       *
       * @return Response
       */
      public function create()
      {
            $categorias = Categoria::all();
            $estados    = Estado::all();

            return View::make('administradores.catalogo.create', compact('categorias', 'estados'));
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
                  $categoria = new Categoria;
                  if (!$categoria->save())
                  {
                        return Redirect::back()->withInput();
                  }
            }
            if (Input::get('subcategoria'))
            {
                  $categoria    = Categoria::findOrFail(Input::get('categoria_id'));
                  $subcategoria = new Subcategoria;
                  $subcategoria->categoria()->associate($categoria);
                  if (!$subcategoria->save())
                  {
                        return Redirect::back()->withInput()->withErrors($subcategoria->errors());
                  }
            }
            if (Input::get('estado'))
            {
                  $estado = new Estado;
                  if (!$estado->save())
                  {
                        return Redirect::back()->withInput()->withErrors($estado->errors());
                  }
            }
            if (Input::get('zona'))
            {
                  $estado = Estado::findOrFail(Input::get('estado_id'));
                  $zona   = new Zona;
                  $zona->estado()->associate($estado);
                  if (!$zona->save())
                  {
                        return Redirect::back()->withInput()->withErrors($zona->errors());
                  }
            }

            Session::flash('message', 'Objeto agregado con éxito');
            Redirect::back();
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
            $tipo = Input::get('tipo');

            if (isset($tipo))
            {
                  $categorias = Categoria::all();
                  $estados    = Estado::all();
                  $objeto     = $tipo::findOrFail($id);
                  return View::make('administradores.catalogo.edit',  compact('tipo','objeto','categorias','estados'));
            }
            else
            {
                  Session::flash('error', 'Elige un elemento para editar');
                  return Redirect::back();
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
                  $object = $tipo::findOrFail($id);

                  if ($object->update())
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
            $tipo = Input::get('tipo');

            if (isset($tipo))
            {
                  $object = $tipo::findOrFail($id);
                  if ($tipo->delete())
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
