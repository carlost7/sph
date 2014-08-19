<?php

use Sph\Storage\Subcategoria\SubcategoriaRepository as Subcat;

class SubcategoriasController extends \BaseController {

      protected $subcat;
      
      public function __construct(Subcat $subcat)
      {
            $this->subcat = $subcat;
      }
      
	/**
	 * Display a listing of the resource.
	 * GET /subcategorias
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /subcategorias/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /subcategorias
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /subcategorias/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /subcategorias/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /subcategorias/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /subcategorias/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
      
      /*
       * obtiene las zonas de un estado especifico
       */
      public function getSubcategorias($categoria_id){
            $subcategorias = $this->subcat->getSubcatByCategoria($categoria_id);
            return Response::json($subcategorias);
      }

}