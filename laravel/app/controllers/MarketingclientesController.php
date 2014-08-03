<?php

class MarketingclientesController extends \BaseController {

	/**
	 * Display a listing of marketingclientes
	 *
	 * @return Response
	 */
	public function index()
	{
		$marketingclientes = Marketingcliente::all();

		return View::make('marketingclientes.index', compact('marketingclientes'));
	}

	/**
	 * Show the form for creating a new marketingcliente
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('marketingclientes.create');
	}

	/**
	 * Store a newly created marketingcliente in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Marketingcliente::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Marketingcliente::create($data);

		return Redirect::route('marketingclientes.index');
	}

	/**
	 * Display the specified marketingcliente.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$marketingcliente = Marketingcliente::findOrFail($id);

		return View::make('marketingclientes.show', compact('marketingcliente'));
	}

	/**
	 * Show the form for editing the specified marketingcliente.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$marketingcliente = Marketingcliente::find($id);

		return View::make('marketingclientes.edit', compact('marketingcliente'));
	}

	/**
	 * Update the specified marketingcliente in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$marketingcliente = Marketingcliente::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Marketingcliente::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$marketingcliente->update($data);

		return Redirect::route('marketingclientes.index');
	}

	/**
	 * Remove the specified marketingcliente from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Marketingcliente::destroy($id);

		return Redirect::route('marketingclientes.index');
	}

}
