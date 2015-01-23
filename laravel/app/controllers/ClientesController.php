<?php

class ClientesController extends \BaseController {

      public function __construct(User $user, Cliente $cliente)
      {
            parent::__construct();
            View::share('section', 'Cliente');
      }

      /**
       * Display a listing of clientes
       *
       * @return Response
       */
      public function index()
      {
            return View::make('clientes.index');
      }

      /**
       * Show the form for editing the specified client.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit()
      {
            return View::make('clientes.edit', compact('cliente', Auth::user()->userable));
      }

      /**
       * Update the specified client in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update()
      {
            $user    = Auth::user();
            $cliente = Auth::user()->userable;

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
                  if ($cliente->update())
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
       * Remove the specified client from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            $user = Auth::user();
            if ($user->delete())
            {
                  $cliente = $user->userable;
                  if ($cliente->delete())
                  {
                        Session::flash('error', 'Cliente eliminado exitosamente');
                        return Redirect::to('/');
                  }
                  else
                  {
                        Session::flash('error', 'No se pudo eliminar el cliente');
                        return Redirect::back();
                  }
            }
            else
            {
                  Session::flash('error', 'No se pudo eliminar el usuario');
                  return Redirect::back();
            }
      }

}
