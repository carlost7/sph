<?php

use Sph\Storage\User\UserRepository as User;
use Sph\Storage\Client\ClientRepository as Client;
use Sph\Storage\Marketing\MarketingRepository as Marketing;

class RegisterController extends \BaseController
{

      protected $user;
      protected $client;
      protected $marketing;

      public function __construct(User $user, Client $client, Marketing $marketing)
      {
            $this->user = $user;
            $this->client = $client;
            $this->marketing = $marketing;
      }

      public function index()
      {
            return View::make('register.index');
      }

      /**
       * Display the form for client registry
       */
      public function register_client()
      {
            return View::make('register.client');
      }

      /**
       * Store the client in the database
       */
      public function store_client()
      {
            $validateUser = new Sph\Services\Validators\User(Input::all(), 'save');
            $validateClient = new Sph\Services\Validators\Client(Input::all(), 'save');

            if ($validateUser->passes() & $validateClient->passes())
            {
                  $user_model = array('password' => Input::get('password'), 'email' => Input::get('email'));
                  $user = $this->user->create($user_model);
                  if (isset($user))
                  {
                        $token = sha1(time());
                        $client_model = array('name' => Input::get('nombre'), 'telephone' => Input::get('telefono'), 'is_active' => false, 'token' => $token, 'user' => $user);
                        $client = $this->client->create($client_model);
                        if (isset($client))
                        {
                              $data = array('nombre' => $client->name,
                                  'token' => $client->token,
                                  'id' => $client->id,
                              );

                              Mail::queue('emails.auth.confirm_new_user', $data, function($message) use ($user, $client)
                              {
                                    $message->to($user->email, $client->name)->subject('Confirmación de Registro de Sphellar');
                              });
                              Session::flash('message', 'Usuario creado con éxito, revisa tu correo para activarlo');

                              return Redirect::to('/');
                        }
                  }
            }
            $user_messages = ($validateUser->getErrors() != null) ? $validateUser->getErrors()->all() : array();
            $client_messages = ($validateClient->getErrors() != null) ? $validateClient->getErrors()->all() : array();
            $validationMessages = array_merge_recursive($user_messages, $client_messages);

            return Redirect::route('register.client')->withInput()->withErrors($validationMessages);
      }

      /*
       * Activate client
       */

      public function activate_client($token, $id)
      {
            $client = $this->client->find($id);
            if (isset($client))
            {
                  if ($token == $client->token)
                  {
                        $client_model = array('is_active' => true, 'token' => '');
                        $client = $this->client->update($id, $client_model);
                        if (isset($client))
                        {
                              $marketing = $this->marketing->asignar_cliente($client);
                              if(isset($marketing)){
                                    return View::make('register.confirmation')->with('confirmation', true);                                    
                              }
                        }
                  }
                  else
                  {
                        Session::flash('error', 'El token no es el mismo');
                        return View::make('register.confirmation')->with('confirmation', false);
                  }
            }
            else
            {
                  Session::flash('error', 'No existe el id');
                  return View::make('regoster.confirmation')->with('confirmation', false);
            }
      }

      /*
       * Display the form for user registry
       */

      public function register_user()
      {
            return View::make('register.user');
      }

      /*
       * Store the new user in the system
       */

      public function store_user()
      {

            $validateUser = new Sph\Services\Validators\User(Input::all(), 'save');
            if ($validateUser->passes())
            {
                  $user_model = array('password' => Input::get('password'), 'email' => Input::get('email'), 'userable' => null);
                  $user = $this->user->create($user_model);
                  if (isset($user))
                  {
                        Session::flash('message', 'El usuario se creo');
                        return Redirect::to('/');
                  }
            }

            return Redirect::route('register.user')->withInput()->withErrors($validateUser->getErrors());
      }

      /*
       * Display the form for marketing registry
       */

      public function register_marketing()
      {
            return View::make('register.marketing');
      }

      /*
       * Store the new marketing user in the database
       */

      public function store_marketing()
      {
            $validateUser = new Sph\Services\Validators\User(Input::all(), 'save');
            $validateMarketing = new Sph\Services\Validators\Marketing(Input::all(), 'save');

            if ($validateUser->passes() & $validateMarketing->passes())
            {
                  $user_model = Input::all();
                  $user = $this->user->create($user_model);
                  if (isset($user))
                  {
                        $marketing_model = Input::all();
                        $marketing_model = array_add($marketing_model, 'user', $user);
                        $marketing = $this->marketing->create($marketing_model);
                        if (isset($marketing))
                        {
                              Session::flash('message', 'Usuario creado con éxito, revisa tu correo para activarlo');

                              return Redirect::to('/');
                        }
                  }
            }
            $user_messages = ($validateUser->getErrors() != null) ? $validateUser->getErrors()->all() : array();
            $marketing_messages = ($validateMarketing->getErrors() != null) ? $validateMarketing->getErrors()->all() : array();
            $validationMessages = array_merge_recursive($user_messages, $marketing_messages);

            return Redirect::route('register.marketing')->withInput()->withErrors($validationMessages);
      }

}
