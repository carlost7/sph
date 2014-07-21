<?php

class PagosController extends \BaseController {

	/**
	 * Display a listing of pagos
	 *
	 * @return Response
	 */
	public function index()
	{
		$pagos = Pago::all();

		return View::make('pagos.index', compact('pagos'));
	}

	/**
	 * Show the form for creating a new pago
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('pagos.create');
	}

	/**
	 * Store a newly created pago in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Pago::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Pago::create($data);

		return Redirect::route('pagos.index');
	}

	/**
	 * Display the specified pago.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$pago = Pago::findOrFail($id);

		return View::make('pagos.show', compact('pago'));
	}

	/**
	 * Show the form for editing the specified pago.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pago = Pago::find($id);

		return View::make('pagos.edit', compact('pago'));
	}

	/**
	 * Update the specified pago in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$pago = Pago::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Pago::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$pago->update($data);

		return Redirect::route('pagos.index');
	}

	/**
	 * Remove the specified pago from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Pago::destroy($id);

		return Redirect::route('pagos.index');
	}

}
