<?php

use Sph\Storage\User\UserRepository as User;
use Sph\Storage\Cliente\ClienteRepository as Cliente;
use Sph\Storage\Marketing\MarketingRepository as Marketing;

class RegisterController extends \BaseController
{

      protected $user;
      protected $cliente;
      protected $marketing;

      public function __construct(User $user, Cliente $cliente, Marketing $marketing)
      {
            $this->user = $user;
            $this->cliente = $cliente;
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
            $validateClient = new Sph\Services\Validators\Cliente(Input::all(), 'save');

            //Validamos datos del usuario y datos del cliente
            if ($validateUser->passes() & $validateClient->passes())
            {
                  //Creamos un usario
                  $user = $this->user->create(Input::all());
                  if (isset($user))
                  {
                        //Creamos un codigo de activación
                        $token = sha1(time());
                        
                        //Se crea el objeto de usuario con los datos de entrada y el usuario al que pertenece
                        $cliente_model = Input::all();
                        $cliente_model = array_push($cliente_model, array('is_active' => false , 'token' => $token , 'user' => $user));
                                                
                        $cliente = $this->cliente->create($cliente_model);
                        
                        if (isset($cliente))
                        {
                              $data = array('nombre' => $cliente->nombre,
                                  'token' => $cliente->token,
                                  'id' => $cliente->id,
                              );

                              Mail::queue('emails.auth.confirm_new_user', $data, function($message) use ($user, $cliente)
                              {
                                    $message->to($user->email, $cliente->nombre)->subject('Confirmación de Registro de Sphellar');
                              });
                              Session::flash('message', 'Usuario creado con éxito, revisa tu correo para activarlo');

                              return Redirect::to('/');
                        }
                  }
            }
            
            //Mensaje de error de validaciones
            $user_messages = ($validateUser->getErrors() != null) ? $validateUser->getErrors()->all() : array();
            $cliente_messages = ($validateClient->getErrors() != null) ? $validateClient->getErrors()->all() : array();
            $validationMessages = array_merge_recursive($user_messages, $cliente_messages);

            return Redirect::route('register.client')->withInput()->withErrors($validationMessages);
      }

      /*
       * Activate client
       */

      public function activate_client($token, $id)
      {
            $cliente = $this->cliente->find($id);
            if (isset($cliente))
            {
                  if ($token == $cliente->token)
                  {
                        $cliente_model = array('is_active' => true, 'token' => '');
                        $cliente = $this->cliente->activar_cliente($id);
                        if (isset($cliente))
                        {
                              $marketing = $this->marketing->asignar_cliente($cliente);

                              return View::make('register.confirmation')->with('confirmation', true);
                        }
                  }
                  else
                  {
                        Session::flash('error', 'El codigo no coincide con tu usuario');
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
                              Session::flash('message', 'Usuario creado con éxito');

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
