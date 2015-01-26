<?php

class ClientesController extends \BaseController {

      public function __construct(User $user, Cliente $cliente)
      {
            parent::__construct();
            View::share('section', 'Cliente');
      }

      public function show($id)
      {
            if ($id != Auth::user()->userable->id)
            {
                  Session::flash('error', 'El cliente no pertenece al usuario registrado');
                  return Redirect::back();
            }
            $cliente = Cliente::find($id);

            return View::make('clientes.show', compact('cliente'));
      }

      /**
       * Show the form for editing the specified client.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            if ($id != Auth::user()->userable->id)
            {
                  Session::flash('error', 'El cliente no pertenece al usuario registrado');
                  return Redirect::back();
            }   
            
            $cliente = Auth::user()->userable;
            return View::make('clientes.edit', compact('cliente'));
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
                        return Redirect::route('publicar.cliente.show',array($cliente->id));
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
