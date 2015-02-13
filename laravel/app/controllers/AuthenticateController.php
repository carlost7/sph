<?php

use Sph\Authenticators\Manager;

class AuthenticateController extends \BaseController {

      protected $manager;
      
      public function __construct(Manager $manager)
      {
            parent::__construct();
            $this->manager = $manager;            
      }

      /**
       * Authorise an authentication request
       *
       * @return Redirect
       */
      public function authorise($provider)
      {
            try {
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
                        return Redirect::to($provider->getAuthorizationUrl());
                  }
            } catch (Exception $e) {
                  return App::abort(404);
            }
      }

      public function callback($provider)
      {
            try {
                  if ($provider == strtolower("twitter"))
                  {
                        $provider = $this->manager->get($provider);

                        $token = $provider->getTokenCredentials(
                                Session::get('credentials'), Input::get('oauth_token'), Input::get('oauth_verifier')
                        );
                        try {
                              $user = $provider->getUserDetails($token);
                              $auth = User::where('uid', $user->uid)->first();
                              //Si existe el usuario, solo lo loggea
                              if ($auth)
                              {
                                    $auth->oauth_token        = Session::get('oauth_token');
                                    $auth->oauth_token_secret = Session::get('oauth_token_secret');

                                    // If so remove the validation rule
                                    $auth::$rules['password']              = '';
                                    $auth::$rules['password_confirmation'] = '';
                                    // Also set autoHash to false;
                                    $auth->autoHashPasswordAttributes      = false;

                                    if ($auth->updateUniques())
                                    {
                                          Auth::loginUsingId($auth->id, true);
                                          return Redirect::intended('/');
                                    }
                                    else
                                    {
                                          Session::flash('error', 'No se pudo autenticar el usuario');
                                          return Redirect::back();
                                    }
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
                        } catch (Exception $e) {

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
                        try {

                              // We got an access token, let's now get the user's details
                              $user = $provider->getUserDetails($token);
                              $auth = User::where('uid', $user->uid)->first();
                              //Si existe el usuario, solo lo loggea
                              if ($auth)
                              {
                                    $auth->oauth_token        = Session::get('oauth_token');
                                    $auth->oauth_token_secret = Session::get('oauth_token_secret');

                                    // If so remove the validation rule
                                    $auth::$rules['password']              = '';
                                    $auth::$rules['password_confirmation'] = '';
                                    // Also set autoHash to false;
                                    $auth->autoHashPasswordAttributes      = false;

                                    if ($auth->updateUniques())
                                    {
                                          Auth::loginUsingId($auth->id, true);
                                          return Redirect::intended('/');
                                    }
                                    else
                                    {
                                          Session::flash('error', 'No se pudo autenticar el usuario');
                                          return Redirect::back();
                                    }
                              }
                              else
                              {

                                    Session::put('username', $userDetails->name);
                                    Session::put('email', $userDetails->email);
                                    Session::put('uid', $userDetails->uid);
                                    Session::put('oauth_token', $token->accessToken);
                                    Session::put('oauth_token_secret', '');

                                    return Redirect::route('authenticate.register');
                              }
                        } catch (Exception $e) {

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
                        try {

                              // We got an access token, let's now get the user's details
                              $user = $provider->getUserDetails($token);
                              $auth = User::where('uid', $user->uid)->first();
                              //Si existe el usuario, solo lo loggea
                              if ($auth)
                              {
                                    $auth->oauth_token        = Session::get('oauth_token');
                                    $auth->oauth_token_secret = Session::get('oauth_token_secret');

                                    // If so remove the validation rule
                                    $auth::$rules['password']              = '';
                                    $auth::$rules['password_confirmation'] = '';
                                    // Also set autoHash to false;
                                    $auth->autoHashPasswordAttributes      = false;

                                    if ($auth->updateUniques())
                                    {
                                          Auth::loginUsingId($auth->id, true);
                                          return Redirect::intended('/');
                                    }
                                    else
                                    {
                                          Session::flash('error', 'No se pudo autenticar el usuario');
                                          return Redirect::back();
                                    }
                              }
                              else
                              {

                                    Session::put('username', $userDetails->name);
                                    Session::put('email', $userDetails->email);
                                    Session::put('uid', $userDetails->uid);
                                    Session::put('oauth_token', $token->accessToken);
                                    Session::put('oauth_token_secret', '');

                                    return Redirect::route('authenticate.register');
                              }
                        } catch (Exception $e) {

                              Session::flash("ocurrio un error, vuelve a intentarlo");
                              Log::error('callback_facebook', print_r($e, true));
                              return Redirect::to("/");
                        }
                  }
            } catch (Exception $e) {
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
            $user                     = new User;
            $user->uid                = Session::get('uid');
            $user->oauth_token        = Session::get('oauth_token');
            $user->oauth_token_secret = Session::get('oauth_token_secret');

            // If so remove the validation rule
            $user::$rules['password']              = '';
            $user::$rules['password_confirmation'] = '';
            // Also set autoHash to false;
            $user->autoHashPasswordAttributes      = false;

            if ($user->save())
            {
                  $miembro = new Miembro;
                  $miembro->user()->associate($user);
                  if ($miembro->create())
                  {
                        Auth::login($user, true);
                        Session::flash('message', 'Bienvenido a Sphellar');
                        return Redirect::intended('/');
                  }
                  else
                  {
                        return Redirect::back()->withErrors($miembro->errors())->withInput();
                  }
            }
            else
            {
                  return Redirect::back()->withErrors($user->errors())->withInput();
            }
      }

}
