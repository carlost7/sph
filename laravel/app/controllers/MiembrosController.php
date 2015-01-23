<?php

class MiembrosController extends \BaseController {

      public function __construct()
      {
            parent::__construct();
            View::share('section', 'Miembro');
      }

      /**
       * Display the specified miembro.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $miembro = Miembro::find($id);
            return View::make('miembros.show')->with(array('miembro' => $miembro));
      }

      /**
       * Show the form for editing the specified miembro.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $miembro = Miembro::find($id);

            return View::make('miembros.edit')->with(array('miembro' => $miembro));
      }

      /**
       * Update the specified miembro in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $user    = Auth::user();
            $miembro = Auth::user()->userable;

            // Check if a password has been submitted
            if (!Input::has('password'))
            {
                  // If so remove the validation rule
                  $user::$rules['password']              = '';
                  $user::$rules['password_confirmation'] = '';
                  // Also set autoHash to false;
                  $user->autoHashPasswordAttributes      = false;
            }
            // Run the update passing a Dynamic beforeSave() closure as the fourth argument
            if ($user->updateUniques(
                            array(), array(), array(), function($user) {
                          // Check for the presence of a blank password field again
                          if (empty($user->password))
                          {
                                // If present remove it from the update
                                unset($user->password);
                                return true;
                          }
                    }))
            {
                  if ($miembro->update())
                  {
                        Session::flash('message', 'Usuario modificado con éxito');
                        return Redirect::route('clientes.index');
                  }
                  else
                  {
                        Session::flash('error', "Error al actualizar el administrador");
                        return Redirect::back()->withInput()->withErrors($cliente->errors());
                  }
            }
            Session::flash('error', "Error al actualizar el usuario");
            return Redirect::back()->withInput()->withErrors($user->errors());
      }

      /**
       * Remove the specified miembro from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            $user = Auth::user();
            if ($user->delete())
            {
                  $miembro = $user->userable;
                  if ($miembro->delete())
                  {
                        Session::flash('error', 'Usuario eliminado exitosamente');
                        return Redirect::to('/');
                  }
                  else
                  {
                        Session::flash('error', 'No se pudo eliminar el usuario');
                        return Redirect::back();
                  }
            }
            else
            {
                  Session::flash('error', 'No se pudo eliminar el usuario');
                  return Redirect::back();
            }
      }

      public function add_rank_negocio($id)
      {
            $negocio = Negocio::find($id);
            if (isset($negocio))
            {
                  $ranks = Auth::user()->userable->ranknegocios->filter(function($ranknegocio) use($id) {
                        return $ranknegocio->negocio_id == $id;
                  });

                  if (count($ranks))
                  {
                        $resultado = array('error' => true, 'mensaje' => 'Ya habias rankeado esto antes');
                  }
                  else
                  {
                        $rank          = new RankNegocio;
                        $rank->miembro()->associate(Auth::user()->userable);
                        $negocio->rank = $negocio->rank + 1;
                        $negocio->ranks()->save($rank);

                        if ($negocio->updateUniques())
                        {
                              $resultado = array('mensaje' => 'Agregado con exito', 'rank' => $negocio->rank);
                        }
                        else
                        {
                              $resultado = array('error' => true, 'mensaje' => 'No se guardo el rank');
                        }
                  }
            }
            else
            {
                  $resultado = array('mensaje', 'No existe el objeto para rankear');
            }

            return Response::json($resultado);
      }

      public function add_rank_evento($id)
      {
            $evento = Evento::find($id);

            if (isset($evento))
            {

                  $ranks = Auth::user()->userable->rankeventos->filter(function($rankevento) use($id) {
                        return $rankevento->evento_id == $id;
                  });

                  if (count($ranks))
                  {
                        $resultado = array('error' => true, 'mensaje' => 'Ya habias rankeado esto antes');
                  }
                  else
                  {
                        $rank         = new RankEvento;
                        $rank->miembro()->associate(Auth::user()->userable);
                        $evento->rank = $evento->rank + 1;
                        $evento->ranks()->save($rank);

                        if ($negocio->updateUniques())
                        {
                              $resultado = array('mensaje' => 'Agregado con exito', 'rank' => $evento->rank);
                        }
                        else
                        {
                              $resultado = array('error' => true, 'mensaje' => 'No se guardo el rank');
                        }
                  }
            }
            else
            {
                  $resultado = array('mensaje', 'No existe el objeto para rankear');
            }

            return Response::json($resultado);
      }

}
