<?php

class AdministradoresController extends \BaseController {

      /**
       * Display a listing of administradors
       *
       * @return Response
       */
      public function index()
      {
            return View::make('administradores.index');
      }

      /**
       * Show the form for editing the specified administrador.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit()
      {
            $administrador = Administrador::find(Auth::user()->userable->id);

            return View::make('administradores.edit', compact('administrador'));
      }

      /**
       * Update the specified administrador in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update()
      {
            $user  = Auth::user();
            $admin = Auth::user()->userable;

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
                  if ($admin->update())
                  {
                        Session::flash('message', 'Usuario modificado con éxito');
                        return Redirect::route('administradores.index');
                  }
                  else
                  {
                        Session::flash('error', "Error al actualizar el administrador");
                        return Redirect::back()->withInput()->withErrors($admin->errors());
                  }
            }
            Session::flash('error', "Error al actualizar el usuario");
            return Redirect::back()->withInput()->withErrors($user->errors());
      }

      /**
       * Remove the specified administrador from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            $user = Auth::user();
            if ($user->delete())
            {
                  $admin = $user->userable;
                  if ($admin->delete())
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
