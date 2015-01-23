<?php

class RegisterController extends \BaseController {

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
            $user    = new User;
            $cliente = new Cliente;

            if ($user->save())
            {
                  $cliente->token     = Crypt::encrypt(sha1(time()));
                  $cliente->is_activo = false;
                  $cliente->user()->associate($user);
                  if ($cliente->save())
                  {
                        $data = array('nombre' => $cliente->nombre,
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
                        $user->delete();
                        return Redirect::back()->withInput()->withErrors($cliente->errors());
                  }
            }
            else
            {
                  return Redirect::back()->withInput()->withErrors($user->errors());
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
                        //Asignamos el cliente a un usuario de marketing;
                        //Obtenemos el conteo de los clientes
                        $clientes           = Cliente::groupBy('marketing_id')->get(array('marketing_id', DB::raw('count(*) as count')));
                        //Obtenemos el marketing que tiene menos 
                        $resultado          = $clientes->lists('count', 'marketing_id');
                        $id                 = array_keys($resultado, min($resultado));

                        $marketing = Marketing::find($id);

                        $cliente->marketing()->associate($id);
                        if ($cliente->updateUnique())
                        {
                              Auth::login($cliente->user);
                              Session::flash("message", 'Activación exitosa');
                              return Redirect::route('publicar.cliente.index');
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

            if ($user->save())
            {
                  $miembro->user()->associate($user);
                  if ($miembro->save())
                  {
                        Session::flash('message', 'Bienvenido a Sphellar');
                        Auth::login($user);                        
                        return Redirect::intended('/');
                  }
                  else
                  {
                        $user->delete();
                        return Redirect::back()->withInput()->withErrors($miembro->errors());
                  }
            }
            else
            {
                  return Redirect::back()->withInput()->withErrors($user->errors());
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
            $user    = new User;
            $marketing = new Marketing;

            if ($user->save())
            {
                  $marketing->user()->associate($marketing);                  
                  if ($marketing->save())
                  {
                        Session::flash('message', 'Bienvenido a Sphellar');
                        Auth::login($user);                        
                        return Redirect::intended('/');
                  }
                  else
                  {
                        $user->delete();
                        return Redirect::back()->withInput()->withErrors($miembro->errors());
                  }
            }
            else
            {
                  return Redirect::back()->withInput()->withErrors($user->errors());
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

            $user    = new User;
            $admin = new Administrador;

            if ($user->save())
            {
                  $admin->user()->associate($user);
                  if ($admin->save())
                  {
                        Session::flash('message', 'Bienvenido a Sphellar');
                        Auth::login($user);                        
                        return Redirect::to('/');
                  }
                  else
                  {
                        $user->delete();
                        return Redirect::back()->withInput()->withErrors($miembro->errors());
                  }
            }
            else
            {
                  return Redirect::back()->withInput()->withErrors($user->errors());
            }
      }

}
