<?php

use Sph\Storage\User\UserRepository as User;

class RegisterController extends \BaseController
{

        protected $user;

        public function __construct(User $user)
        {
                $this->user = $user;
        }

        /**
         * Display a listing of the resource.
         * GET /register
         *
         * @return Response
         */
        public function index()
        {
                return View::make('register.index');
        }

        /**
         * Store a newly created resource in storage.
         * POST /register
         *
         * @return Response
         */
        public function store()
        {
                $v = new Sph\Services\Validators\User;
                if ($v->passes())
                {
                        //$this->user->create($input);
                }

                return Redirect::route('register.index')->withInput()->withErrors($v->getErrors());
        }

}
