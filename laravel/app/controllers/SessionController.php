<?php

use Sph\Storage\User\UserRepository as User;

class SessionController extends \BaseController
{

      protected $user;

      public function __construct(User $user)
      {
            $this->user = $user;
      }

      /**
       * Display a listing of the resource.
       * GET /session
       *
       * @return Response
       */
      public function create()
      {
            return View::make('session.create');
      }

      /**
       * Store a newly created resource in storage.
       * POST /session
       *
       * @return Response
       */
      public function store()
      {
            if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), Input::get('rememberme')))
            {

                  if (is_a(Auth::user()->userable, Cliente::class))
                  {
                        Session::set('is_client', true);
                        return Redirect::intended(route('clientes.index'));
                  }
                  elseif (is_a(Auth::user()->userable, Marketing::class))
                  {
                        Session::set('is_marketing', true);
                        return Redirect::intended(route('marketings.index'));
                  }
                  elseif (is_a(Auth::user()->userable, Administrador::class))
                  {
                        Session::set('is_admin', true);
                        return Redirect::intended(route('administradores.index'));
                  }
                  else
                  {
                        Session::flash('error', 'No se reconoce el tipo de usuario');
                        return Redirect::intended('/');
                  }
            }
            return Redirect::route('session.create')
                            ->withInput()
                            ->with('login_errors', true);
      }

      /**
       * Remove the specified resource from storage.
       * DELETE /session/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy()
      {
            Auth::logout();
            return View::make('session.destroy');
      }

}
