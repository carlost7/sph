<?php

class MarketingController extends \BaseController
{


      public function __construct(User $user, Marketing $marketing)
      {
            parent::__construct();
            View::share('section','Marketing');
      }

      /**
       * Display a listing of marketing
       *
       * @return Response
       */
      public function index()
      {
            return View::make('marketing.index');
      }

      /**
       * Show the form for editing the specified marketing.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit()
      {
            return View::make('marketing.edit');
      }

      /**
       * Update the specified marketing in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update()
      {
            $user    = Auth::user();
            $marketing = Auth::user()->userable;

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
                  if ($marketing->update())
                  {
                        Session::flash('message', 'Usuario modificado con éxito');
                        return Redirect::route('clientes.index');
                  }
                  else
                  {
                        Session::flash('error', "Error al actualizar el administrador");
                        return Redirect::back()->withInput()->withErrors($marketing->errors());
                  }
            }
            Session::flash('error', "Error al actualizar el usuario");
            return Redirect::back()->withInput()->withErrors($user->errors());
      }

      /**
       * Remove the specified marketing from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            $user = Auth::user();
            if ($user->delete())
            {
                  $marketing = $user->userable;
                  if ($marketing->delete())
                  {
                        Session::flash('error', 'Marketing eliminado exitosamente');
                        return Redirect::to('/');
                  }
                  else
                  {
                        Session::flash('error', 'No se pudo eliminar el marketing');
                        return Redirect::back();
                  }
            }
            else
            {
                  Session::flash('error', 'No se pudo eliminar el marketing');
                  return Redirect::back();
            }
      }

}
