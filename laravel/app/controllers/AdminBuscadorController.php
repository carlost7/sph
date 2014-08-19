<?php

use Sph\Storage\Categoria\CategoriaRepository as Categoria;
use Sph\Storage\Subcategoria\SubcategoriaRepository as Subcategoria;
use Sph\Storage\Estado\EstadoRepository as Estado;
use Sph\Storage\Zona\ZonaRepository as Zona;

class AdminBuscadorController extends \BaseController {

      protected $categoria;
      protected $subcategoria;
      protected $estado;
      protected $zona;
      
      public function __construct(Categoria $categoria, Subcategoria $subcat, Estado $estado, Zona $zona)
      {
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
            
            return View::make('administradores.buscador.index')->with(array('categorias'=>$categorias,
                                                                            'subcategorias'=>$subcategorias,
                                                                            'estados'=>$estados,
                                                                            'zonas'=>$zonas,));
            
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /adminbuscador/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('administradores.buscador.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /adminbuscador
	 *
	 * @return Response
	 */
	public function store()
	{
		
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
		
	}

}