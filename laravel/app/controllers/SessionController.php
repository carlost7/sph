<?php

use Sph\Storage\User\UserRepository as User;
use Sph\Authenticators\Manager;

class SessionController extends \BaseController
{

      protected $user;
      protected $manager;

      public function __construct(User $user, Manager $manager)
      {
            $this->user = $user;
            $this->manager = $manager;
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
                        Session::set('is_cliente', true);
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
                        return Redirect::intended('/');
                  }
            }
            return Redirect::route('session.create')
                            ->withInput()
                            ->with('login_errors', true);
      }

      public function authorise($provider)
      {
            try
            {
                  $provider = $this->manager->get($provider);

                  $credentials = $provider->getTemporaryCredentials();

                  Session::put('credentials', $credentials);
                  Session::save();

                  return $provider->authorize($credentials);
            }
            catch (Exception $e)
            {
                  return App::abort(404);
            }
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
            Session::flash('message','Vuelve pronto');
            return Redirect::to('/');
      }

}
