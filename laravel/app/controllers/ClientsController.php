<?php

use Sph\Storage\User\UserRepository as User;
use Sph\Storage\Client\ClientRepository as Client;

class ClientsController extends \BaseController
{

      protected $user;
      protected $client;

      public function __construct(User $user, Client $client)
      {
            $this->user = $user;
            $this->client = $client;
      }

      /**
       * Display a listing of clients
       *
       * @return Response
       */
      public function index()
      {
            return View::make('clients.index');
      }

      /**
       * Show the form for editing the specified client.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit()
      {
            return View::make('clients.edit');
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
            $validateClient = new Sph\Services\Validators\Client(Input::all(), 'update');

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
                        $client_model = array();
                        if ("" !== Input::get('nombre'))
                        {
                              $client_model = array_add($client_model, "name", Input::get('nombre'));
                        }
                        if ("" !== Input::get('telefono'))
                        {
                              $client_model = array_add($client_model, "telephone", Input::get('telefono'));
                        }
                        $client = $this->client->update(Auth::user()->userable->id, $client_model);
                        if (isset($client))
                        {
                              Session::flash('message', 'Usuario modificado con éxito');
                              return Redirect::route('clients.index');
                        }
                  }
            }
            $user_messages = ($validateUser->getErrors() != null) ? $validateUser->getErrors()->all() : array();
            $client_messages = ($validateClient->getErrors() != null) ? $validateClient->getErrors()->all() : array();
            $validationMessages = array_merge_recursive($user_messages, $client_messages);

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
            Client::destroy($id);

            return Redirect::route('clients.index');
      }

}
