<?php

class PromocionesController extends \BaseController
{

      /**
       * Display a listing of promociones
       *
       * @return Response
       */
      public function index()
      {
            $promociones = Promocione::all();

            return View::make('promociones.index', compact('promociones'));
      }

      /**
       * Show the form for creating a new promocione
       *
       * @return Response
       */
      public function create()
      {
            return View::make('promociones.create');
      }

      /**
       * Store a newly created promocione in storage.
       *
       * @return Response
       */
      public function store()
      {
            $validator = Validator::make($data = Input::all(), Promocione::$rules);

            if ($validator->fails())
            {
                  return Redirect::back()->withErrors($validator)->withInput();
            }

            Promocione::create($data);

            return Redirect::route('promociones.index');
      }

      /**
       * Display the specified promocione.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $promocione = Promocione::findOrFail($id);

            return View::make('promociones.show', compact('promocione'));
      }

      /**
       * Show the form for editing the specified promocione.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $promocione = Promocione::find($id);

            return View::make('promociones.edit', compact('promocione'));
      }

      /**
       * Update the specified promocione in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $promocione = Promocione::findOrFail($id);

            $validator = Validator::make($data = Input::all(), Promocione::$rules);

            if ($validator->fails())
            {
                  return Redirect::back()->withErrors($validator)->withInput();
            }

            $promocione->update($data);

            return Redirect::route('promociones.index');
      }

      /**
       * Remove the specified promocione from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            Promocione::destroy($id);

            return Redirect::route('promociones.index');
      }

}
