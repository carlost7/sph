<?php

use Sph\Storage\User\UserRepository as User;
use Sph\Storage\Client\ClientRepository as Client;

class RegisterController extends \BaseController
{

        protected $user;
        protected $client;

        public function __construct(User $user, Client $client)
        {
                $this->user = $user;
                $this->client = $client;
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
                $validateUser = new Sph\Services\Validators\User;
                $validateClient = new Sph\Services\Validators\Client;

                if ($validateUser->passes() & $validateClient->passes())
                {
                        $user_model = array('password' => Input::get('password'), 'email' => Input::get('email'));
                        $user = $this->user->create($user_model);
                        if (isset($user))
                        {
                                $token = 'abcd';
                                $client_model = array('name' => Input::get('nombre'), 'telephone' => Input::get('telefono'), 'is_active' => false, 'token' => $token, 'user' => $user);
                                $client = $this->client->create($client_model);
                                if (isset($client))
                                {
                                        Session::flash('message', 'El usuario se creo');
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

                $validateUser = new Sph\Services\Validators\User;
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
                $v = new Sph\Services\Validators\User;
                if ($v->passes())
                {
                        
                }
                return Redirect::route('register.marketing')->withInput()->withErrors($v->getErrors());
        }

}
