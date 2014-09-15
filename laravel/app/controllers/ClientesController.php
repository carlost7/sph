<?php

use Sph\Storage\User\UserRepository as User;
use Sph\Storage\Cliente\ClienteRepository as Cliente;

class ClientesController extends \BaseController
{

      protected $user;
      protected $cliente;

      public function __construct(User $user, Cliente $cliente)
      {
            parent::__construct();
            $this->user = $user;
            $this->client = $cliente;
            View::share('section','Cliente');
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
            return View::make('clientes.edit')->with('cliente',Auth::user()->userable);
      }

      /**
       * Update the specified client in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update()
      {
            $validateUser = new Sph\Services\Validators\User(Input::all(), 'update');
            $validateClient = new Sph\Services\Validators\Cliente(Input::all(), 'update');

            if ($validateUser->passes() & $validateClient->passes())
            {
                  $user_model = array();
                  if ("" !== Input::get('password'))
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
                        $cliente_model = Input::all();
                        $cliente = $this->client->update(Auth::user()->userable->id, $cliente_model);
                        if (isset($cliente))
                        {
                              Session::flash('message', 'Usuario modificado con éxito');
                              return Redirect::route('clientes.index');
                        }
                  }
            }
            $user_messages = ($validateUser->getErrors() != null) ? $validateUser->getErrors()->all() : array();
            $cliente_messages = ($validateClient->getErrors() != null) ? $validateClient->getErrors()->all() : array();
            $validationMessages = array_merge_recursive($user_messages, $cliente_messages);

            return Redirect::back()->withInput()->withErrors($validationMessages);
      }

      /**
       * Remove the specified client from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            Cliente::destroy($id);

            return Redirect::route('clientes.index');
      }

}
