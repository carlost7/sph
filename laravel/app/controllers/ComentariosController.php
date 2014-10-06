<?php

class ComentariosController extends \BaseController {

	/**
	 * Display a listing of comentarios
	 *
	 * @return Response
	 */
	public function index()
	{
		$comentarios = Comentario::all();

		return View::make('comentarios.index', compact('comentarios'));
	}

	/**
	 * Show the form for creating a new comentario
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('comentarios.create');
	}

	/**
	 * Store a newly created comentario in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Comentario::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Comentario::create($data);

		return Redirect::route('comentarios.index');
	}

	/**
	 * Display the specified comentario.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$comentario = Comentario::findOrFail($id);

		return View::make('comentarios.show', compact('comentario'));
	}

	/**
	 * Show the form for editing the specified comentario.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$comentario = Comentario::find($id);

		return View::make('comentarios.edit', compact('comentario'));
	}

	/**
	 * Update the specified comentario in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$comentario = Comentario::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Comentario::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$comentario->update($data);

		return Redirect::route('comentarios.index');
	}

	/**
	 * Remove the specified comentario from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Comentario::destroy($id);

		return Redirect::route('comentarios.index');
	}

}
