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
                  $provider = $this->manager->get($provider);

                  $credentials = $provider->getTemporaryCredentials();

                  Session::put('credentials', $credentials);
                  Session::save();

                  $provider->authorize($credentials);
            }
            catch (Exception $e)
            {
                  return App::abort(404);
            }
      }

      public function callback($provider)
      {
            try
            {
                  //dd(Session::all());
                  $provider = $this->manager->get($provider);

                  $token = $provider->getTokenCredentials(
                          Session::get('credentials'), Input::get('oauth_token'), Input::get('oauth_verifier')
                  );

                  $user = $provider->getUserDetails($token);

                  $auth = $this->user->findByUid($user->uid);

                  if ($auth)
                  {
                        $data = array(
                              'uid' => Session::get('uid'),
                              'oauth_token' => Session::get('oauth_token'),
                              'oauth_token_secret' => Session::get('oauth_token_secret')
                        );
                        $user = $this->user->update($auth->id,$data);
                        
                        Auth::loginUsingId($auth->id,true);
                        
                        return Redirect::to('/');
                  }

                  Session::put('username', $user->nickname);
                  Session::put('uid', $user->uid);
                  Session::put('oauth_token', $token->getIdentifier());
                  Session::put('oauth_token_secret', $token->getSecret());
                  //Session::save();

                  Log::error('entrada');
                  return Redirect::route('authenticate.register');
            }
            catch (Exception $e)
            {
                  Log::error("Authenticate::callback ".$e->getMessage());
                  return App::abort(404);
            }
      }

      public function register()
      {
            return View::make('register.authenticate.user')->with('username', Session::get('username'));
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
                              Auth::login($user,true);
                              Session::flash('message', 'Bienvenido a Sphellar');
                              return Redirect::to('/');
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
