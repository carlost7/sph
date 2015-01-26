<?php

use Illuminate\Events\Dispatcher;

class RegisterController extends \BaseController {

      protected $event;

      public function __construct(Dispatcher $event)
      {
            parent::__construct();
            $this->event = $event;
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
            $user               = new User;
            $cliente            = new Cliente;
            $cliente->token     = sha1(time());
            $cliente->is_activo = false;
            if ($cliente->save())
            {
                  if ($cliente->user()->save($user))
                  {
                        $data = array(
                            'nombre' => $cliente->nombre,
                            'token'  => $cliente->token,
                            'id'     => $cliente->id,
                        );

                        Mail::send('emails.auth.confirm_new_user', $data, function($message) use ($user, $cliente) {
                              $message->to($user->email, $cliente->nombre)->subject('Confirmación de Registro de Sphellar');
                        });

                        Session::flash('message', 'Usuario creado con éxito, revisa tu correo para activarlo');

                        return Redirect::to('/');
                  }
                  else
                  {
                        $cliente->delete();
                        return Redirect::back()->withInput()->withErrors($user->errors());
                  }
            }
            else
            {
                  return Redirect::back()->withInput()->withErrors($cliente->errors());
            }
      }

      /*
       * Activate client
       */

      public function activate_client($token, $id)
      {
            $cliente = Cliente::find($id);
            if (isset($cliente))
            {
                  if ($token == $cliente->token)
                  {
                        $cliente->is_activo = true;
                        $cliente->token     = '';
                        //Asignamos el cliente a un usuario de marketing;
                        //Obtenemos el conteo de los clientes
                        $clientes           = Cliente::whereNotNull('marketing_id')->groupBy('marketing_id')->get(array('marketing_id', DB::raw('count(*) as count')));
                        if (count($clientes))
                        {
                              //Obtenemos los marketings que no tienen ningun cliente
                              $marketings = Marketing::all()->lists('id');
                              $mktInTable = $clientes->lists('marketing_id');
                              $resultados = array_diff($marketings, $mktInTable);
                              if (count($resultados))
                              {
                                    $marketing = Marketing::find(reset($resultados));
                              }
                              else
                              {
                                    //Obtenemos el marketing que tiene menos 
                                    $resultado = $clientes->lists('count', 'marketing_id');
                                    $id        = array_keys($resultado, min($resultado));
                                    $marketing = Marketing::find($id[0]);
                              }
                        }
                        else
                        {
                              $marketing = Marketing::first();
                        }

                        $cliente->marketing()->associate($marketing);
                        if ($cliente->updateUniques())
                        {
                              Auth::login($cliente->user);
                              Session::flash("message", 'Activación exitosa');
                              $this->event->fire("enviar_codigo", array($cliente));
                              return Redirect::route('publicar.cliente.show',$cliente->id);
                        }
                        else
                        {
                              Session::flash('error', 'No se activo el usuario');
                              return View::make('register.confirmation')->with('confirmation', false);
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
                  return View::make('register.confirmation')->with('confirmation', false);
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

            $user    = new User;
            $miembro = new Miembro;

            if ($miembro->save())
            {
                  if ($miembro->user()->save($user))
                  {
                        Session::flash('message', 'Bienvenido a Sphellar');
                        Auth::login($user);
                        return Redirect::intended('/');
                  }
                  else
                  {
                        $miembro->delete();
                        return Redirect::back()->withInput()->withErrors($user->errors());
                  }
            }
            else
            {
                  return Redirect::back()->withInput()->withErrors($miembro->errors());
            }
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
            $user      = new User;
            $marketing = new Marketing;

            if ($marketing->save())
            {
                  if ($marketing->user->save($user))
                  {
                        Session::flash('message', 'Bienvenido a Sphellar');
                        Auth::login($user);
                        return Redirect::intended('/');
                  }
                  else
                  {
                        $marketing->delete();
                        return Redirect::back()->withInput()->withErrors($user->errors());
                  }
            }
            else
            {
                  return Redirect::back()->withInput()->withErrors($marketing->errors());
            }
      }

      /*
       * Display the form for marketing registry
       */

      public function register_admin()
      {
            return View::make('register.admin');
      }

      /*
       * Store the new admin user in the database
       */

      public function store_admin()
      {

            $user  = new User;
            $admin = new Administrador;

            if ($admin->save())
            {
                  if ($admin->user()->save($user))
                  {
                        Session::flash('message', 'Bienvenido a Sphellar');
                        Auth::login($user);
                        return Redirect::to('/');
                  }
                  else
                  {
                        $admin->delete();
                        return Redirect::back()->withInput()->withErrors($user->errors());
                  }
            }
            else
            {
                  return Redirect::back()->withInput()->withErrors($admin->errors());
            }
      }

}
