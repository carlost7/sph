<?php

use Sph\Storage\User\UserRepository as User;
use Sph\Storage\Administrador\AdministradorRepository as Administrador;

class AdministradoresController extends \BaseController
{

      protected $user;
      protected $admin;

      public function __construct(User $user, Administrador $admin)
      {
            parent::__construct();
            $this->user = $user;
            $this->admin = $admin;            
      }

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
            $administrador = $this->admin->find(Auth::user()->userable->id);

            return View::make('administradores.edit')->with('administrador',$administrador);
      }

      /**
       * Update the specified administrador in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update()
      {
            $validateUser = new Sph\Services\Validators\User(Input::all(), 'update');
            $validateAdmin = new Sph\Services\Validators\Administrador(Input::all(), 'update');

            if ($validateUser->passes() & $validateAdmin->passes())
            {
                  $user_model = array();
                  $password = Input::get('password');
                  if ($password != "")
                  {
                        $user_model = array_add($user_model, "password", Input::get('password'));
                  }
                  if ("" !== Input::get('email'))
                  {
                        $user_model = array_add($user_model, "email", Input::get('email'));
                  }
                  $user = $this->user->update(Auth::user()->id, $user_model);
                  if (isset($user))
                  {
                        $admin_model = Input::all();
                        $admin = $this->admin->update(Auth::user()->userable->id, $admin_model);
                        if (isset($admin))
                        {
                              Session::flash('message', 'Usuario modificado con éxito');
                              return Redirect::route('administradores.index');
                        }
                  }
            }
            $user_messages = ($validateUser->getErrors() != null) ? $validateUser->getErrors()->all() : array();
            $admin_messages = ($validateAdmin->getErrors() != null) ? $validateAdmin->getErrors()->all() : array();
            $validationMessages = array_merge_recursive($user_messages, $admin_messages);
            
            return Redirect::back()->withInput()->withErrors($validationMessages);
      }

      /**
       * Remove the specified administrador from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            Administrador::destroy($id);

            return Redirect::route('administradors.index');
      }

}
