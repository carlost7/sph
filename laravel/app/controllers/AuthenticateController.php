<?php

use Illuminate\Events\Dispatcher;
use Sph\Authenticators\Manager;
use Sph\Storage\User\UserRepository as User;
use Sph\Storage\Miembro\MiembroRepository as Miembro;

class AuthenticateController extends \BaseController
{

      protected $manager;
      protected $user;
      protected $miembro;
      protected $events;

      public function __construct(Manager $manager, User $user, Miembro $miembro, Dispatcher $events)
      {
            parent::__construct();
            $this->manager = $manager;
            $this->user = $user;
            $this->miembro = $miembro;
            $this->events = $events;
      }

      /**
       * Authorise an authentication request
       *
       * @return Redirect
       */
      public function authorise($provider)
      {
            try
            {
                  if ($provider == strtolower('twitter'))
                  {
                        $provider = $this->manager->get($provider);

                        $credentials = $provider->getTemporaryCredentials();

                        Session::put('credentials', $credentials);
                        Session::save();

                        return Redirect::to($provider->authorize($credentials));
                  }
                  else
                  {
                        $provider = $this->manager->get($provider);
                        //dd($provider);
                        return Redirect::to($provider->getAuthorizationUrl());
                  }
            } catch (Exception $e)
            {
                  return App::abort(404);
            }
      }

      public function callback($provider)
      {
            try
            {
                  if ($provider == strtolower("twitter"))
                  {
                        //dd(Session::all());
                        $provider = $this->manager->get($provider);

                        $token = $provider->getTokenCredentials(
                                Session::get('credentials'), Input::get('oauth_token'), Input::get('oauth_verifier')
                        );
                        try
                        {
                              $user = $provider->getUserDetails($token);

                              $auth = $this->user->findByUid($user->uid);
                              //Si existe el usuario, solo lo loggea
                              if ($auth)
                              {
                                    $data = array(
                                        'oauth_token' => Session::get('oauth_token'),
                                        'oauth_token_secret' => Session::get('oauth_token_secret')
                                    );
                                    $user = $this->user->update($auth->id, $data);

                                    Auth::loginUsingId($auth->id, true);

                                    return Redirect::intended('/');
                              }
                              else
                              {
                                    //Si no existe lo manda a crear un nuevo usuario

                                    Session::put('username', $user->name);
                                    Session::put('uid', $user->uid);
                                    Session::put('oauth_token', $token->getIdentifier());
                                    Session::put('oauth_token_secret', $token->getSecret());
                                    //Session::save();

                                    return Redirect::route('authenticate.register');
                              }
                        } catch (Exception $e)
                        {

                              Session::flash("ocurrio un error, vuelve a intentarlo");
                              Log::error('callback_facebook', print_r($e, true));
                              return Redirect::to("/");
                        }
                  }
                  elseif ($provider == strtolower("facebook"))
                  {
                        $provider = $this->manager->get($provider);
                        if (Input::get('error'))
                        {

                              Session::flash('error', 'Ocurrio un error o no le diste acceso a la aplicación');
                              return Redirect::route('register.user');
                        }


                        $token = $provider->getAccessToken('authorization_code', array('code' => Input::get('code')));


                        // Optional: Now you have a token you can look up a users profile data
                        try
                        {

                              // We got an access token, let's now get the user's details
                              $userDetails = $provider->getUserDetails($token);
                              $auth = $this->user->findByUid($userDetails->uid);

                              if ($auth)
                              {
                                    $data = array(
                                        'oauth_token' => Session::get('oauth_token'),
                                        'oauth_token_secret' => Session::get('oauth_token_secret')
                                    );
                                    $user = $this->user->update($auth->id, $data);

                                    Auth::loginUsingId($auth->id, true);

                                    return Redirect::intended('/');
                              }

                              Session::put('username', $userDetails->name);
                              Session::put('email', $userDetails->email);
                              Session::put('uid', $userDetails->uid);
                              Session::put('oauth_token', $token->accessToken);
                              Session::put('oauth_token_secret', '');

                              return Redirect::route('authenticate.register');
                        } catch (Exception $e)
                        {

                              Session::flash("ocurrio un error, vuelve a intentarlo");
                              Log::error('callback_facebook', print_r($e, true));
                              return Redirect::to("/");
                        }
                  }
                  else
                  {
                        $provider = $this->manager->get($provider);
                        if (Input::get('error'))
                        {

                              Session::flash('error', 'Ocurrio un error o no le diste acceso a la aplicación');
                              return Redirect::route('register.user');
                        }

                        $token = $provider->getAccessToken('authorization_code', array('code' => Input::get('code')));


                        // Optional: Now you have a token you can look up a users profile data
                        try
                        {

                              // We got an access token, let's now get the user's details
                              $userDetails = $provider->getUserDetails($token);
                              $auth = $this->user->findByUid($userDetails->uid);

                              if ($auth)
                              {
                                    $data = array(
                                        'oauth_token' => Session::get('oauth_token'),
                                        'oauth_token_secret' => Session::get('oauth_token_secret')
                                    );
                                    $user = $this->user->update($auth->id, $data);

                                    Auth::loginUsingId($auth->id, true);

                                    return Redirect::intended('/');
                              }

                              Session::put('username', $userDetails->name);
                              Session::put('email', $userDetails->email);
                              Session::put('uid', $userDetails->uid);
                              Session::put('oauth_token', $token->accessToken);
                              Session::put('oauth_token_secret', '');

                              return Redirect::route('authenticate.register');
                        } catch (Exception $e)
                        {

                              Session::flash("ocurrio un error, vuelve a intentarlo");
                              Log::error('callback_facebook', print_r($e, true));
                              return Redirect::to("/");
                        }
                  }
            } catch (Exception $e)
            {
                  Log::error("Authenticate::callback " . $e->getMessage());
                  return App::abort(404);
            }
      }

      public function register()
      {
            return View::make('register.authenticate.user')->with(array('username' => Session::get('username'), 'email' => Session::get('email')));
      }

      public function store()
      {
            $data = array(
                'username' => Input::get('username'),
                'email' => Input::get('email'),
                'uid' => Session::get('uid'),
                'oauth_token' => Session::get('oauth_token'),
                'oauth_token_secret' => Session::get('oauth_token_secret')
            );

            $validateAuth = new \Sph\Services\Validators\Auth1($data, 'save');
            $validateMember = new \Sph\Services\Validators\Miembro($data, 'save');

            if ($validateAuth->passes() & $validateMember->passes())
            {
                  $user = $this->user->create($data);
                  if ($user)
                  {
                        $miembro_model = $data;
                        $miembro_model = array_add($miembro_model, 'user', $user);

                        $miembro = $this->miembro->create($miembro_model);

                        if ($miembro)
                        {
                              $this->events->fire('nuevo_usuario_correo', array($miembro));
                              Auth::login($user, true);
                              Session::flash('message', 'Bienvenido a Sphellar');
                              return Redirect::intended('/');
                        }
                        else
                        {
                              Session::flash('error', "Error al guardar el usuario");
                        }
                  }
                  else
                  {
                        Session::flash('error', 'Error al crear el usuario, vuelve a intentarlo');
                  }
            }

            $auth_messages = ($validateAuth->getErrors() != null) ? $validateAuth->getErrors()->all() : array();
            $member_messages = ($validateMember->getErrors() != null) ? $validateMember->getErrors()->all() : array();
            $validationMessages = array_merge_recursive($auth_messages, $member_messages);

            return Redirect::back()->withErrors($validationMessages)->withInput();
      }

}
